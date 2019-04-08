<?php
/**
 * Created by PhpStorm.
 * User: Surface
 * Date: 19/03/2019
 * Time: 21:17
 */

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class UserContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('adress')
            ->add('codePostale')
            ->add('ville')
            ->add('country')
            ->add('email')
            ->add('password')
            ->add('telephone')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}