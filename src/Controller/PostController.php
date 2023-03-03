<?php

namespace App\Controller;

use App\Entity\Commentary;
use App\Entity\Post;
use App\Form\CommentaryType;
use App\Repository\CommentaryRepository;
use App\Repository\PostRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $opinion = $form->getData();

            if ($this->getUser() != null) {
                $opinion->setUser($this->getUser());
                $em = $doctrine->getManager();
                $em->persist($commentary);
                $em->flush();

                return $this->redirectToRoute('app_blog_post', ['post' => $post->getId()]);
            }
        }

        return $this->render('test.html.twig', [
            'form' => $form->createView(),
            'post' => $post
        ]);
    }
}