<?php

namespace App\Form;

use App\Entity\Identifiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class IdentifiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quoi',null,[
                'label' => 'Quoi',
                'attr' => [
                    'placeholder' => 'Quoi...',
                    'class' => 'form-control form-control-sm col-12'
                ],
                'required'=>true,
            ])
            ->add('ou',null,[
                'label' => 'Où',
                'attr' => [
                    'placeholder' => 'Où...',
                    'class' => 'form-control form-control-sm col-12'
                ],
                'required'=>true,
            ])
            ->add('identifiant',null,[
                'label' => 'Identifiant',
                'attr' => [
                    'placeholder' => 'Login...',
                    'class' => 'form-control form-control-sm col-12'
                ],
                'required'=>true,
            ])
            ->add('mdp',PasswordType::class,[
                'label' => 'Mot de passe',
                'attr' => [
                    'placeholder' => 'Mot de passe...',
                    'class' => 'form-control form-control-sm col-12'
                ],
                'required'=>true,
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
            'data_class' => Identifiant::class,
        ]);
    }
}
