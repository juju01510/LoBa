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

        return $this->render('blogs/blogs.html.twig', [
            'posts' => $posts
        ]);
    }

    #[Route('/blog/{post}', name:'app_blog_post')]
    public function show(Request $request, Post $post, PostRepository $postRepository, ManagerRegistry $doctrine): Response
    {
        $post = $postRepository->find($post);

        return $this->render('blogs/blog.html.twig', [
            'post' => $post,
        ]);
    }
}