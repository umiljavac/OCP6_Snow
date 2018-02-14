<?php
/**
 * Created by PhpStorm.
 * User: ulrich
 * Date: 13/01/2018
 * Time: 19:57
 */

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\UserType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends Controller
{
    /**
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @Route("/register", name="user_registration")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder, \Swift_Mailer $mailer)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ( $form->isSubmitted() && $form->isValid())
        {
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $activationToken = md5($user->getEmail());
            $user->setActivationToken($activationToken);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->sendConfirmation($mailer, $user, $activationToken);
            $this->addFlash('login', 'Un email a été envoyé dans ta boîte mail, merci de cliquer sur le lien qu\'il contient pour finaliser ton inscription !');
            return $this->redirectToRoute('home');
        }
        return $this->render(
            'views/register.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @param Request $request
     * @Route("/validation/{token}/user/{id}", name="register_validation", requirements={"id"="\d+"})
     */
    public function registerValidationAction($token, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->find(User::class, $id);

        if(!$user)
        {
            throw $this->createNotFoundException('Désolé c\'est moche : tu n\'éxiste pas :( Try again !');
        }

        $activationToken = $user->getActivationToken();
        $message = $this->checkValidationToken($token, $activationToken, $user);
        $em->persist($user);
        $em->flush();
        $this->addFlash('login', $message);
        return $this->redirectToRoute('home');
    }

    public function checkValidationToken($requestToken, $activationToken, $user)
    {
        if ($requestToken === $activationToken)
        {
            $user->setActive(true);
            $user->setActivationToken(null);

            $message = 'Félicitations ! Ton inscription est terminée, tu peux maintenant te connecter :)';
        }
        else
        {
            $message = 'Oops ! La validation de ton compte a échoué. Rééssaye de valider le lien dans ton email';
        }
        return $message;
    }

    public function sendConfirmation( \Swift_Mailer $mailer, $user, $validationToken)
    {
        $message = (new \Swift_Message())
            ->setSubject('Snow Tricks : validation de votre compte')
            ->setFrom('ulm_ulm@hotmail.com')
            ->setTo($user->getEmail())
            ->setBody(
                $this->renderView('emails/registrationValidation.html.twig',
                    array(
                          'token' => $validationToken,
                          'user'  => $user)
                ),
                'text/html'
            );
        $mailer->send($message);
    }
}
