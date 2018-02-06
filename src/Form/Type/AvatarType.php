<?php
/**
 * Created by PhpStorm.
 * User: ulrich
 * Date: 31/01/2018
 * Time: 21:06
 */

namespace App\Form\Type;


use App\Entity\Avatar;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AvatarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('file', FileType::class
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Avatar::class
        ));
    }
}
