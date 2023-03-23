<?php

namespace App\Controller;

use App\Entity\Newsletter\Users;
use App\Form\NewsletterUserType;
use App\Repository\Newsletter\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsletterUserController extends AbstractController
{
    #[Route('/newsletter', name: 'app_newsletter_index')]
    public function index(Request $request, UserRepository $userRepository): Response
    {
        $user = new Users();

        $form = $this->CreateForm(NewsletterUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $token = hash('sha256', uniqid());

            $user->setValidationToken($token);

            $userRepository->save($user, true);

            $this->addFlash('message', 'Validation email sent successfully !');
            return $this->redirectToRoute('app_home');
        }

        return $this->render('newsletter_user/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}
