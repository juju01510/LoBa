<?php

namespace App\Controller;

use App\Entity\Newsletter\Users;
use App\Form\NewsletterUserType;
use App\Repository\Newsletter\UserRepository;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class NewsletterUserController extends AbstractController
{
    /**
     * @throws TransportExceptionInterface
     */
    #[Route('/newsletter', name: 'app_newsletter_index')]
    public function index(Request $request, UserRepository $userRepository, MailerInterface $mailer): Response
    {
        $user = new Users();

        $form = $this->CreateForm(NewsletterUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $token = hash('sha256', uniqid());

            $user->setValidationToken($token);

            $userRepository->save($user, true);

            $email = (new TemplatedEmail())
                ->from('julien.asinari@live.fr')
                ->to($user->getEmail())
                ->subject('Votre inscription à la newsletter')
                ->htmlTemplate('email/inscription.html.twig')
//                ->context(compact('user', 'token'))
            ;

            $mailer->send($email);

            $this->addFlash('message', 'Validation email sent successfully !');
            return $this->redirectToRoute('app_home');
        }

        return $this->render('newsletter_user/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}
