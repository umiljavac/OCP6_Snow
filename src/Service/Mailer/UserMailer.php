<?php
/**
 * Created by PhpStorm.
 * User: ulrich
 * Date: 05/03/2018
 * Time: 14:14
 */

namespace App\Service\Mailer;

use App\Entity\User;
use Psr\Container\ContainerInterface;

class UserMailer
{
    private $mailer;
    private $container;
    const FROM = 'ulm_ulm@hotmail.com';
    const SUBJECT_REGISTER = 'Snow Tricks : validation de votre compte';
    const SUBJECT_RESETPW = 'Snow Tricks : réinitialisation de ton mot de passe';
    const TEMPLATE_REGISTER = 'emails/registrationValidation.html.twig';
    const TEMPLATE_RESETPW =  'emails/resetPasswordValidation.html.twig';

    public function __construct(\Swift_Mailer $mailer, ContainerInterface $container)
    {
        $this->mailer = $mailer;
        $this->container = $container;
    }

    /**
     * @param User $user
     * @param $subject
     * @param $template
     * @param $token
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function sendMailWithToken(User $user, $subject, $template, $token)
    {
        $message = (new \Swift_Message())
            ->setSubject($subject)
            ->setFrom(self::FROM)
            ->setTo($user->getEmail())
            ->setBody(
                $this->container->get('twig')->render(
                    $template,
                    array(
                        'token' => $token,
                        'user' => $user)
                ),
                'text/html'
            );
        $this->mailer->send($message);
    }
}
