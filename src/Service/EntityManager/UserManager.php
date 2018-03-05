<?php
/**
 * Created by PhpStorm.
 * User: ulrich
 * Date: 03/03/2018
 * Time: 20:21
 */

namespace App\Service\EntityManager;

use App\Entity\User;
use App\Form\Type\UpdatePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Type\UserRegistrationType;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserManager
 * @package App\Service\EntityManager
 */
class UserManager
{
    private $em;
    private $repository;
    private $mailer;
    private $formFactory;
    private $passwordEncoder;
    private $flashBag;
    private $container;

    public function __construct(
        EntityManagerInterface $em,
        \Swift_Mailer $mailer,
        FormFactoryInterface $formFactory,
        UserPasswordEncoderInterface $passwordEncoder,
        FlashBagInterface $flashBag,
        ContainerInterface $container
    ) {
        $this->em = $em;
        $this->repository = $em->getRepository(User::class);
        $this->mailer = $mailer;
        $this->formFactory = $formFactory;
        $this->passwordEncoder = $passwordEncoder;
        $this->flashBag = $flashBag;
        $this->container = $container;
    }

    /**
     * @param $request
     * @return bool|\Symfony\Component\Form\FormView
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function registerUser(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserRegistrationType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $activationToken = md5($user->getEmail());
            $user->setActivationToken($activationToken);
            $this->em->persist($user);
            $this->em->flush();
            $this->sendRegistrationConfirmation($user, $activationToken);
            $this->flashBag->add('login', 'Un email a été envoyé dans ta boîte mail, 
                                                 merci de cliquer sur le lien qu\'il contient pour 
                                                 finaliser ton inscription !');
            return true;
        }
        return $form->createView();
    }

    /**
     * @param $token
     */
    public function userAccountValidation($token)
    {
        $repository = $this->em->getRepository(User::class);
        $user = $repository->findOneBy(['activationToken' => $token]);
        if (!$user) {
            throw $this->createNotFoundException('Désolé c\'est moche : tu n\'éxiste pas :( Try again !');
        }
        $user->setActive(true);
        $user->setActivationToken(null);
        $this->em->flush();
    }

    /**
     * @param Request $request
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function resetPassword(Request $request)
    {
        $username = $request->request->get('username');
        $user = $this->repository->findOneBy(['username' => $username]);
        if (!$user) {
            throw $this->createNotFoundException('Tu as dû mal orthographier ton pseudo , try again !');
        }
        $resetToken = md5($user->getEmail());
        $user->setResetPasswordToken($resetToken);
        $this->em->flush();
        $this->sendResetPasswordConfirmation($user, $resetToken);
    }

    /**
     * @param Request $request
     * @param $token
     * @return bool|\Symfony\Component\Form\FormView
     */
    public function updateUserPassword(Request $request, $token)
    {
        $user = $this->repository->findOneBy(['resetPasswordToken' => $token]);
        if (!$user) {
            throw $this->createNotFoundException('Il semble que tu n\'existe pas dans la base de données.. 
                                                  Recommence, sait-on jamais :)');
        }
        $form = $this->createForm(UpdatePasswordType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form["plainPassword"]->getData();
            $password = $this->passwordEncoder->encodePassword($user, $plainPassword);
            $user->setPassword($password);
            $user->setResetPasswordToken(null);
            $this->em->flush();
            return true;
        }
        return $form->createView();
    }

    /**
     * @param User $user
     * @param $validationToken
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function sendRegistrationConfirmation(User $user, $validationToken)
    {
        $message = (new \Swift_Message())
            ->setSubject('Snow Tricks : validation de votre compte')
            ->setFrom('ulm_ulm@hotmail.com')
            ->setTo($user->getEmail())
            ->setBody(
                $this->container->get('twig')->render(
                    'emails/registrationValidation.html.twig',
                    array(
                        'token' => $validationToken,
                        'user'  => $user)
                ),
                'text/html'
            );
        $this->mailer->send($message);
    }

    /**
     * @param $user
     * @param $resetToken
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function sendResetPasswordConfirmation(User $user, $resetToken)
    {
        $message = (new \Swift_Message())
            ->setSubject('Snow Tricks : réinitialisation de ton mot de passe')
            ->setFrom('ulm_ulm@hotmail.com')
            ->setTo($user->getEmail())
            ->setBody(
                $this->container->get('twig')->render(
                    'emails/resetPasswordValidation.html.twig',
                    array(
                        'token' => $resetToken,
                        'user' => $user)
                ),
                'text/html'
            );
        $this->mailer->send($message);
    }

    /**
     * @param $type
     * @param null $data
     * @param array $options
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createForm($type, $data = null, array $options = array())
    {
        return $this->formFactory->create($type, $data, $options);
    }

    /**
     * @param string $message
     * @param \Exception|null $previous
     * @return NotFoundHttpException
     */
    protected function createNotFoundException(string $message = 'Not Found', \Exception $previous = null): NotFoundHttpException
    {
        return new NotFoundHttpException($message, $previous);
    }
}
