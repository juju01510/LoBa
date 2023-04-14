<?php

namespace App\Controller;

use App\Entity\Commentary;
use App\Form\MessageType;
use App\Repository\CommentaryRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    /**
     * @throws TransportExceptionInterface
     */
    #[Route('/message/new/{_locale}', name: 'app_message_new')]
    public function new(Request $request, CommentaryRepository $commentaryRepository, MailerInterface $mailer, $_locale = ''): Response
    {

        $message = new Commentary();
        $dateTime = new \DateTime;

        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        $message->setDateCreated($dateTime);


        if ($_locale === '') {
            $locale = 'default';
        } else {
            $locale = $_locale;
        }

        if ($request->isMethod('post')) {
            $locale = $request->request->get('lang');

            if ($form->isSubmitted() && $form->isValid()) {

                $commentaryRepository->save($message, true);

                $email = (new TemplatedEmail())
                    ->from($message->getEmail())
                    ->to('onglobainternational@gmail.com')
                    ->subject('New message Lôba\'s website')
                    ->htmlTemplate('email/message.html.twig')
                    ->context(compact('message'))
                ;

                $mailer->send($email);

                $this->addFlash('message', 'Message sent successfully!');
                return $this->redirectToRoute('app_home');
            }
            return $this->redirectToRoute('app_message_new', ['_locale' => $locale]);
        }

        return $this->render('message/new.html.twig', [
            'message' => $message,
            'form' => $form
        ]);
    }
}
