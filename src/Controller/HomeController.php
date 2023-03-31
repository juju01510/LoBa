<?php

namespace App\Controller;

use App\Repository\IntroductionRepository;
use App\Repository\SectionRepository;
use App\Repository\TranslationRepository;
use App\Service\TranslationService;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
        #[Route('/', name: 'app_home')]
        public function index(IntroductionRepository $introductionRepository, SectionRepository $sectionRepository, Request $request, TranslationService $translationService, TranslationRepository $translationRepository): Response
        {
            $locale = $request->query->get('lang') ?? 'default';

            if ($locale === 'en') {
                $locale = 'default';
            }

            if ($locale !== 'default') {
                $request->setLocale($locale);
            }

            $sectionsTrans = $translationService->getAvailableTranslation('sections', 'section', $translationRepository, ['section.title', 'section.content']);
            $introTrans = $translationService->getTranslation('introduction', $translationRepository, ['introduction.content']);

            $intro = $introductionRepository->findIntro();
            $sections = $sectionRepository->findByAvailable();

            return $this->render('base.html.twig', [
                'intro' => $intro,
                'introTrans' => $introTrans,
                'sections' => $locale === 'default' ? $sections : $sectionsTrans,
                'locale' => $locale
            ]);
        }

    #[Route('/test', name: 'app_test')]
    public function test(): Response
    {
        return $this->render('members/index.html.twig');
    }
}

