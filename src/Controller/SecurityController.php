<?php
/**
 * Created by PhpStorm.
 * User: ulrich
 * Date: 14/01/2018
 * Time: 23:08
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends Controller
{

    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, AuthenticationUtils $authUtils)
    {
        $error = $authUtils->getLastAuthenticationError();

        $lastUserName = $authUtils->getLastUsername();

        return $this->render('views/login.html.twig', array(
            'last_username' => $lastUserName,
            'error' => $error
        ));
    }
}