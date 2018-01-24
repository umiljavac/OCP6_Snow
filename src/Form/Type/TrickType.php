<?php
/**
 * Created by PhpStorm.
 * User: ulrich
 * Date: 09/01/2018
 * Time: 17:24
 */

namespace App\Form\Type;


use App\Entity\Image;
use App\Entity\TrickGroup;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('trickGroup', EntityType::class, array(
                'class' => TrickGroup::class,
                'choice_label' => 'name'
            ))
            ->add('description', TextareaType::class)
           ->add('images', CollectionType::class, array (
               'entry_type' => ImageType::class,
               'required' => false,
               'allow_add' => true,
               'allow_delete' => true))
           ->add('videos', CollectionType::class, array(
               'entry_type' => VideoType::class,
                  'required' => false,
                  'allow_add' => true,
                  'allow_delete' => true))
            ->add('enregistrer', SubmitType::class)
            ;
    }
}
