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
    #[Route('/projects', name: 'app_projects')]
    public function index(ProjectRepository $projectRepository, Request $request, TranslationRepository $translationRepository, TranslationService $translationService): Response
    {
        $locale = $request->query->get('lang') ?? 'default';

        if ($locale === 'en') {
            $locale = 'default';
        }

        if ($locale !== 'default') {
            $request->setLocale($locale);
        }

        $projectsTrans = $translationService->getTranslation('projects', $translationRepository, ['project.title', 'project.content']);

        $projects = $projectRepository->findAll();

        return $this->render('projects/projects.html.twig', [
            'projects' => $projects,
            'ps' => $projectsTrans,
            'locale' => $locale
        ]);
    }
}