<?php

namespace App\Controller;

use App\Repository\PartnersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartnersController extends AbstractController
{
    #[Route('/partners', name: 'app_partners_index', methods: ['GET'])]
    public function index(PartnersRepository $partnersRepository): Response
    {
        $partners = $partnersRepository->findAvailable();

        return $this->render('partners/partners.html.twig', [
            'partners' => $partners
        ]);
    }
}