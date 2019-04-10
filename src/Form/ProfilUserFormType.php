<?php

namespace App\Form;

use App\Entity\ProfilUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfilUserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo',TextType::class, [
                'data_class' => null,
                'required'=>true,
                'label'=>"Votre pseudo",
                'attr'=>[
                    'placeholder'=>"Saisissez votre pseudo",
                    'class' => 'form-control col-md-12'
                ]
            ])
            ->add('presentation', TextareaType::class, [
                'label'=>"Votre presentation: ",
                'attr' =>[
                    'class' => 'form-control placeholder_message',
                    'rows'=>6,
                    'placeholder' => "Saisissez votre presentation"

                ]
            ])
            ->add('age', IntegerType::class, [
                'required' => false,
                'label' => "Votre age",
                'attr' => [
                    'placeholder' => "Saisissez votre age"
                ]
            ])
            ->add('photo', FileType::class, [
                'label'=>"Image",
                'data_class' => null,
                'attr'=> [
                    'class'=>'form-control col-md-12 form-control-file dropify'
                ]
            ])
            ->add('adress')
            ->add('codePostale')
            ->add('ville')
            ->add('country')
            ->add('telephone')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProfilUser::class,
        ]);
    }
}
