<?php

namespace App\Form;

use App\Entity\Pointage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class PointageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('createdAt',DateTimeType::class,[
            'label' => 'Heure',
            'widget' => 'single_text',
            'required' => false,
            'attr' => [
                'class' => 'form-control form-control-sm col-12',
            ],
        ])
        ->add('onoff', ChoiceType::class, [
            'choices' => [
                'Ouverture' => 1,
                'Fermeture' => 2
            ],
            'expanded' => false,
            'attr' => [
                'class' => 'form-control form-control-sm col-12',
            ],
            'label' => 'Ouverture / Fermeture' 
        ]) 
        ->add('submit',SubmitType::class,[
            'label' => 'Enregistrer',
            'attr' => [
                'class' => 'btn btn-success btn-sm col-1'
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pointage::class,
        ]);
    }
}
