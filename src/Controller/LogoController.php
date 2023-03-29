<?php

namespace App\Controller;

use App\Repository\LogoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LogoController extends AbstractController
{
    #[Route('/logo', name: 'app_logo')]
    public function index(LogoRepository $logoRepository): Response
    {
        $logo = $logoRepository->findAvailable();

        dump($logo);
        return $this->render('partials/logo.html.twig',[
            'logo' => $logo,
        ]);
    }
}
