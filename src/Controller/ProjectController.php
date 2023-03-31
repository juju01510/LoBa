<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use App\Repository\TranslationRepository;
use App\Service\TranslationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    #[Route('/projects/{_locale}', name: 'app_projects')]
    public function index(ProjectRepository $projectRepository, Request $request, TranslationRepository $translationRepository, TranslationService $translationService, $_locale = ''): Response
    {
        if ($_locale === '') {
            $locale = 'default';
        } else {
            $locale = $_locale;
        }

        if ($request->isMethod('post')) {
            $locale = $request->request->get('lang');

            return $this->redirectToRoute('app_projects', ['_locale' => $locale]);
        }

        $locale == 'en' ? $locale = 'default' : $locale;
        $locale != 'default' ? $request->setLocale($locale) : null;

        $projectsTrans = $translationService->getTranslation($projectRepository, ['project.title', 'project.content']);

        $projects = $projectRepository->findAll();

        return $this->render('projects/projects.html.twig', [
            'projects' => $projects,
            'ps' => $projectsTrans,
            'locale' => $locale
        ]);
    }
}