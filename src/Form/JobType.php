<?php

namespace App\Form;

use App\Entity\Job;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class, [
                'label' => 'Veuillez montionner le titre de l\'annonce du Job :',
                'attr' => [
                    'placeholder' => "Le titre de l\'annonce du Job"
                ]
            ])


            ->add('description', TextareaType::class, [
                'label' => 'Veuillez montionner la description du Job :',
                'attr' => [
                    'placeholder' => "Description du Job"
                ]
            ])


            ->add('createdAt', DateType::class, [
            'widget' => 'choice',
                'attr' => [
                     'placeholder' => "Date du produit"
                ]
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Job::class,
        ]);
    }
}
