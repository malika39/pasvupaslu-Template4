<?php

namespace App\Form;



use App\Entity\Editeur;

use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditeurType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => false])
            ->add('lastName', TextType::class, ['label' => false])
            ->add('address', TextType::class, ['label' => false])
            ->add('city', TextType::class, ['label' => false])
            ->add('postCode', IntegerType::class, ['label' => false])
            ->add('phone', TelType::class, ['label' => false])
            ->add('function', TextareaType::class, ['label' => false])
            ->add('imagesAdmin', CollectionType::class, [
                'entry_type' => ImageAdminType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false,
                'attr'         => [
                    'class' => "collection",
                ],
           ])
            ->add('questions', CollectionType::class, [
                'entry_type' => QuestionType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'required'=>false,
                'label' => false,
                'attr'         => [
                    'class' => "collection",
                ],
            ])
        ;


    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\Editeur',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'App_editeur';
    }
}
