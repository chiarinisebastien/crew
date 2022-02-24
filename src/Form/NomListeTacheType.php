<?php

namespace App\Form;

use App\Entity\NomListeTache;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class NomListeTacheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('title',null,[
            'label' => 'Titre',
            'attr' => [
                'placeholder' => 'titre...',
                'class' => 'form-control form-control-sm col-12'
            ],
            'required'=>true,
        ])
            ->add('submit',SubmitType::class,[
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'btn btn-success btn-sm col-2'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NomListeTache::class,
        ]);
    }
}
