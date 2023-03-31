<?php

namespace App\Controller;

use App\Entity\Commentary;
use App\Form\MessageType;
use App\Repository\CommentaryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    #[Route('/message/new/{_locale}', name: 'app_message_new')]
    public function new(Request $request, CommentaryRepository $commentaryRepository, $_locale = ''): Response
    {
        if ($_locale === '') {
            $locale = 'default';
        } else {
            $locale = $_locale;
        }

        if ($request->isMethod('post')) {
            $locale = $request->request->get('lang');

            return $this->redirectToRoute('app_message_new', ['_locale' => $locale]);
        }

        $message = new Commentary();

        $dateTime = new \DateTime;

        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        $message->setDateCreated($dateTime);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentaryRepository->save($message, true);

            return $this->redirectToRoute('app_message_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('message/new.html.twig', [
            'message' => $message,
            'form' => $form
        ]);
    }
}
