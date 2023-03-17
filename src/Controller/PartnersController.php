<?php

namespace App\Controller;

use App\Repository\PartnersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class PartnersController extends AbstractController
{
public function index(PartnersRepository $partnersRepository): Response
{
    $partners = $partnersRepository->findAvailable();

    return $this->render('test.html.twig', [
        'partners' => $partners
    ]);
}
}