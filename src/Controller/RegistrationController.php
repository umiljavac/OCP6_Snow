<?php
/**
 * Created by PhpStorm.
 * User: ulrich
 * Date: 13/01/2018
 * Time: 19:57
 */

namespace App\Controller;

use App\Service\EntityManager\UserManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends Controller
{
    /**
     * @param Request $request
     * @param UserManager $userManager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @Route("/register", name="user_registration")
     */
    public function registerAction(Request $request, UserManager $userManager)
    {
        $managerResponse = $userManager->registerUser($request);
        if ($managerResponse === true) {
            $this->addFlash('login', 'Un email a été envoyé dans ta boîte mail, 
                                           merci de cliquer sur le lien qu\'il contient 
                                           pour finaliser ton inscription !');
            return $this->redirectToRoute('home');
        }
        return $this->render('views/register.html.twig', array('form' => $managerResponse));
    }

    /**
     * @param UserManager $userManager
     * @param $token
     * @return mixed
     * @Route("/register/{token}/validation", name="register_validation")
     */
    public function registerValidationAction($token, UserManager $userManager)
    {
        $userManager->userAccountValidation($token);

        $this->addFlash('login', 'Félicitations ! Ton inscription est terminée, 
                                                tu peux maintenant te connecter :)');
        return $this->redirectToRoute('home');
    }
}
