<?php

namespace App\Controller;

use App\Repository\MemberRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MemberController extends AbstractController
{
    #[Route('/members/{_locale}')]
    public function index(MemberRepository $memberRepository, $_locale = ''): Response
    {
        $members = $memberRepository->findAll();

        return $this->render('truc.html.twig', [
            'members' => $members
        ]);
    }
}