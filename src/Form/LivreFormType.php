<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Livres;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivreFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',TextType::class, [
                'data_class' => null,
                'required'=>true,
                'label'=>"Titre de livre",
                'attr'=>[
                    'placeholder'=>"Titre de l'oeuvre",
                    'class' => 'form-control col-md-12'
                ]
            ])
            ->add('extract',TextareaType::class, [
                'label'=>"extract",'data_class' => null,
                'attr'=>[
                    'class' => 'col-md-12',
                    'name'=> "editor1"
                ]
            ])



            ->add('photo', FileType::class, [
                'label'=>"Image",
                'data_class' => null,
                'attr'=> [
                    'class'=>'dropify'
                ]
            ])

            ->add('categorie', EntityType::class,[
                'label'=>"Categorie",'data_class' => null,
                'class'=>Categories::class,
                'choice_label'=>"categorie",
                'expanded'=>false,
                'multiple'=>false,
                'attr'=>[
                    'class' => 'form-control col-md-12'
                ]

            ])
//            ->add('user')
            ->add('submit', SubmitType::class, [
                'label' => 'Publier mon Livre'
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Livres::class,
        ]);
    }
}
