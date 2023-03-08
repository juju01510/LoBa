<?php

namespace App\Controller;

use App\Entity\Commentary;
use App\Entity\Like;
use App\Entity\Post;
use App\Form\CommentaryType;
use App\Form\LikeType;
use App\Repository\CommentaryRepository;
use App\Repository\PostRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class PostController extends AbstractController {
    #[Route('/blog', name:'app_blog')]
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findAll();

        return $this->render('test.html.twig', [
            'posts' => $posts
        ]);
    }

    #[Route('/blog/{post}', name:'app_blog_post')]
    public function show(Request $request, Post $post, PostRepository $postRepository, ManagerRegistry $doctrine): Response
    {
        $post = $postRepository->find($post);

        $commentary = new Commentary();
        $commentary->setPost($post);
        $form = $this->createForm(CommentaryType::class, $commentary);

        $like = new Like();
        $like->setPost($post);
        $likeForm = $this->createForm(LikeType::class, $like);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $commentary = $form->getData();

            if ($this->getUser() != null) {
                $commentary->setUser($this->getUser());
                $commentary->setDateCreated(new DateTime('now'));

                $em = $doctrine->getManager();
                $em->persist($commentary);
                $em->flush();

                return $this->redirectToRoute('app_blog_post', ['post' => $post->getId()]);
            }
        }

        $likeForm->handleRequest($request);
        if ($likeForm->isSubmitted() && $likeForm->isValid()) {
            $like = $likeForm->getData();

            if ($this->getUser() != null) {
                $like->setUser($this->getUser());

                $em = $doctrine->getManager();
                $em->persist($like);
                $em->flush();

                return $this->redirectToRoute('app_blog_post', ['post' => $post->getId()]);
            }
        }

        return $this->render('test.html.twig', [
            'commentaryForm' => $form->createView(),
            'post' => $post,
            'likeForm' => $likeForm->createView(),
        ]);
    }
}