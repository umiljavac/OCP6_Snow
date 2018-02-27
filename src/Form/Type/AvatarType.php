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
use Symfony\Component\Validator\Constraints\File;

class AvatarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('file', FileType::class, array(
            'constraints' => new File(['mimeTypes' => array('image/jpg', 'image/jpeg', 'image/png', 'image/gif')])
            )
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Avatar::class
        ));
    }
}
