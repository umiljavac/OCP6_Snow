<?php
/**
 * Created by PhpStorm.
 * User: ulrich
 * Date: 12/02/2018
 * Time: 22:08
 */

namespace App\Controller;

use App\Service\EntityManager\UserManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
     * @param UserManager $userManager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @Route("/request/password", name="request_password")
     */
    public function requestPassword(Request $request, UserManager $userManager)
    {
        $userManager->resetPassword($request);

        $this->addFlash('login', 'Un email de réinitialisation de mot de passe 
                                        vient d\'être envoyé dans ta boîte mail, 
                                        connecte toi sur ta messagerie et suis les instructions :)');

        return $this->redirectToRoute('home');
    }

    /**
     * @param Request $request
     * @param $token
     * @param UserManager $userManager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/update/{token}/password", name="update_password")
     */
    public function updatePassword(Request $request, $token, UserManager $userManager)
    {
        $managerResponse = $userManager->updateUserPassword($request, $token);
        if ($managerResponse === true) {
            $this->addFlash('login', 'Done ! Mot de passe réinitialisé : tu peux maintenant te connecter !');
            return $this->redirectToRoute('home');
        }
        return $this->render('views/updatePassword.html.twig', array('form' => $managerResponse));
    }
}
