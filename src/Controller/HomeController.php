<?php

namespace App\Controller;

use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }

    #[Route('/test', name: 'app_test')]
    public function test(): Response
    {
        return $this->render('projects/projects.html.twig');
    }

    #[Route('/testt', name: 'app_testt')]
    public function testt(): Response
    {
        return $this->render('blogs/blogs.html.twig');
    }

    #[Route('/testtt', name: 'app_testtt')]
    public function testtt(): Response
    {
        return $this->render('register/register.html.twig');
    }

    #[Route('/testttt', name: 'app_testttt')]
    public function testttt(): Response
    {
        return $this->render('blogs/blog.html.twig');
    }
}

