<?php
/**
 * Created by PhpStorm.
 * User: ulrich
 * Date: 31/01/2018
 * Time: 20:57
 */

namespace App\Form\Type;


use App\Entity\Avatar;
use App\Entity\UserProfile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('avatar', AvatarType::class, array(
                'required' => false,
                'label' => 'Lassé de ton avatar ? Change !'
            ))
            ->add('infos', TextareaType::class )
            ->add('enregistrer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => UserProfile::class
        ));
    }

}
