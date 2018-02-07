<?php
/**
 * Created by PhpStorm.
 * User: ulrich
 * Date: 31/01/2018
 * Time: 15:16
 */

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\UserProfileType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserProfileController
 * @package App\Controller
 */
class UserProfileController extends Controller
{
    /**
     * @Route("/profile/{id}", name="show_profile", requirements={"id"="\d+"})
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->find(User::class, $id);
        if(!$user)
        {
            throw $this->createNotFoundException('Pas de compte pas de chocolat.. so sad.. ');
        }
        $userProfile = $user->getUserProfile();
        return $this->render('views/profile.html.twig', array('showUser' => $user, 'userProfile' => $userProfile));
    }

    /**
     * @Route("/profile/update", name="update_profile")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request)
    {
        $user = $this->getUser();
        if(!$user)
        {
            throw $this->createNotFoundException('Vous devez créer un compte !');
        }
        $userProfile = $user->getUserProfile();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(UserProfileType::class, $userProfile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em->flush();
            $this->addFlash('notice', 'Votre profil est à jour !');
            return $this->redirectToRoute('show_profile', array('id' => $user->getId()));
        }
        return $this->render('views/updateProfile.html.twig', array('user' => $user, 'userProfile' => $userProfile, 'form' => $form->createView()));
    }
}
