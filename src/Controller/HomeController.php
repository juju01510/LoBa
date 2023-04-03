<?php

namespace App\Controller;

use App\Repository\IntroductionRepository;
use App\Repository\SectionRepository;
use App\Service\TranslationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home/{_locale}', name: 'app_home')]
    public function index(IntroductionRepository $introductionRepository, SectionRepository $sectionRepository, Request $request, TranslationService $translationService, $_locale = ''): Response
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

        $sectionsTrans = $translationService->getAvailableTranslation($sectionRepository, ['section.title', 'section.content']);
        $introTrans = $translationService->getTranslation($introductionRepository, ['introduction.content']);

        $intro = $introductionRepository->findIntro();
        $sections = $sectionRepository->findByAvailable();

        return $this->render('base.html.twig', [
            'intro' => ($locale === 'default' || empty($introTrans)) ? $intro : $introTrans,
            'sections' => ($locale === 'default' || empty($sectionsTrans)) ? $sections : $sectionsTrans,
            'locale' => $locale
        ]);
    }

    #[Route('/webmasters/{_locale}', name: 'app_test')]
    public function test($_locale = 'en', Request $request): Response
    {
        if ($_locale === '') {
            $locale = 'default';
        } else {
            $locale = $_locale;
        }

        if ($request->isMethod('post')) {
            $locale = $request->request->get('lang');

            return $this->redirectToRoute('app_test', ['_locale' => $locale]);
        }

        $locale == 'en' ? $locale = 'default' : $locale;
        $locale != 'default' ? $request->setLocale($locale) : null;

            return $this->render('webmasters/index.html.twig', [
            'locale' => $locale
        ]);
    }
}

