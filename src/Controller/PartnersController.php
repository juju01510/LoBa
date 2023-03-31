<?php

namespace App\Controller;

use App\Repository\PartnersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartnersController extends AbstractController
{
    #[Route('/partners/{_locale}', name: 'app_partners_index')]
    public function index(PartnersRepository $partnersRepository, $_locale = '', Request $request): Response
    {
        if ($_locale === '') {
            $locale = 'default';
        } else {
            $locale = $_locale;
        }

        if ($request->isMethod('post')) {
            $locale = $request->request->get('lang');

            return $this->redirectToRoute('app_home', ['_locale' => $locale]);
        }

        $locale == 'en' ? $locale = 'default' : $locale;
        $locale != 'default' ? $request->setLocale($locale) : null;
        $partners = $partnersRepository->findAvailable();

        return $this->render('partners/partners.html.twig', [
            'partners' => $partners
        ]);
    }
}