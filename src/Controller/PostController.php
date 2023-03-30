<?php

namespace App\Controller;

use App\Entity\Commentary;
use App\Entity\Like;
use App\Entity\Post;
use App\Form\CommentaryType;
use App\Form\LikeType;
use App\Repository\CommentaryRepository;
use App\Repository\PostRepository;
use App\Service\TranslationService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class PostController extends AbstractController
{
    #[Route('/blog/{lang}', name: 'app_blog')]
    public function index(PostRepository $postRepository, Request $request, TranslationService $translationService, string $lang = ''): Response
    {
        if ($lang === '') {
            $locale = 'default';
        } else {
            $locale = $lang;
        }

        if ($request->isMethod('post')) {
            $locale = $request->request->get('lang');

            return $this->redirectToRoute('app_blog', ['lang' => $locale]);
        }

        $locale == 'en' ? $locale = 'default' : $locale;
        $locale != 'default' ? $request->setLocale($locale) : null;

        $posts = $postRepository->findAll();

        $postsTrans = $translationService->getTranslation($postRepository, ['post.title', 'post.content']);

        return $this->render('blogs/blogs.html.twig', [
            'posts' => ($locale === 'default' || empty($postsTrans)) ? $posts : $postsTrans,
            'locale' => $locale
        ]);
    }

    #[Route('/blog/{post}/{lang}', name: 'app_blog_post')]
    public function show(Request $request, Post $post, PostRepository $postRepository, TranslationService $translationService, string $lang = ''): Response
    {
        if ($lang === '') {
            $locale = 'default';
        } else {
            $locale = $lang;
        }

        if ($request->isMethod('post')) {
            $locale = $request->request->get('lang');

            return $this->redirectToRoute('app_blog_post', ['lang' => $locale]);
        }

        $locale == 'en' ? $locale = 'default' : $locale;
        $locale != 'default' ? $request->setLocale($locale) : null;

        $post = $postRepository->find($post);

        $postTrans = $translationService->getOneTranslation($post, $postRepository, ['post.title', 'post.content']);

        return $this->render('blogs/blog.html.twig', [
            'post' => ($locale === 'default' || empty($postTrans) ? $post : $postTrans),
            'locale' => $locale
        ]);
    }
}