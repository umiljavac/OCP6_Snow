<?php
/**
 * Created by PhpStorm.
 * User: ulrich
 * Date: 12/02/2018
 * Time: 22:08
 */

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\UpdatePasswordType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PasswordController extends Controller
{
    /**
     * @Route("/forgotten/password", name="forgotten_password")
     */
    public function show()
    {
        return $this->render('views/forgottenPassword.html.twig');
    }

    /**
     * @param Request $request
     * @Route("/request/password", name="request_password")
     */
    public function requestPassword(Request $request, \Swift_Mailer $mailer)
    {
        $username = $request->request->get('username');
        $repo = $this->getDoctrine()->getRepository(User::class);
        $em = $this->getDoctrine()->getManager();
        $user = $repo->findOneBy(['username' => $username]);
        if (!$user)
        {
            throw $this->createNotFoundException('Tu as dû mal orthographier ton nom, try again !');
        }
        $resetToken = md5($user->getEmail());
        $user->setResetPasswordToken($resetToken);
        $em->persist($user);
        $em->flush();
        $this->sendToken($mailer, $user, $resetToken);

        $this->addFlash('login','Un email de réinitialisation de mot de passe vient d\'être envoyé dans ta boîte mail, connecte toi sur ta messagerie et suis les instructions :)' );
        return $this->redirectToRoute('home');
    }

    public function sendToken(\Swift_Mailer $mailer, $user, $resetToken)
    {
        $message = (new \Swift_Message())
                ->setSubject('Snow Tricks : réinitialisation de ton mot de passe')
                ->setFrom('ulm_ulm@hotmail.com')
                ->setTo($user->getEmail())
                ->setBody(
                    $this->renderView('emails/resetPasswordValidation.html.twig',
                        array(
                            'token' => $resetToken,
                            'user' => $user)
                    ),
                'text/html'
                );
        $mailer->send($message);
    }

    /**
     * @Route("/check/{token}/password", name="check_reset_token")
     */
    public function checkToken($token)
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->findOneBy(['resetPasswordToken' => $token]);
        if(!$user) {
            throw $this->createNotFoundException('Il semble que tu n\'existe pas dans la base de données.. Recommence, sait-on jamais :)' );
        }
        return $this->redirectToRoute('update_password', array('id' => $user->getId()));
    }

    /**
     * @param User $user
     * @Route("/update/{id}/password", name="update_password")
     */
    public function updatePassword(Request $request, UserPasswordEncoderInterface $passwordEncoder, User $user)
    {

        $form = $this->createForm(UpdatePasswordType::class);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid())
        {
            $plainPassword = $form["plainPassword"]->getData();
            $password = $passwordEncoder->encodePassword($user, $plainPassword);
            $user->setPassword($password);
            $user->setResetPasswordToken(null);
            $em->persist($user);
            $em->flush();
            $this->addFlash('login', 'Done ! Mot de passe réinitialisé : tu peux maintenant te connecter !');
            return $this->redirectToRoute('home');
        }
        return $this->render('views/updatePassword.html.twig', array('form' => $form->createView()));
    }
}
