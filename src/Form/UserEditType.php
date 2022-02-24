<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\AdminDeparture;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('username',null,[
            'label' => 'Adresse email',
            'attr' => [
                'placeholder' => 'Adresse email',
                'class' => 'form-control form-control-sm col-12'
            ]
        ])
        ->add('firstname',null,[
            'label' => 'Prénom',
            'attr' => [
                'placeholder' => 'Prénom',
                'class' => 'form-control form-control-sm col-12'
            ]
        ])
        ->add('lastname',null,[
            'label' => 'Nom',
            'attr' => [
                'placeholder' => 'Nom',
                'class' => 'form-control form-control-sm col-12'
            ]
        ])
        ->add('roles', ChoiceType::class, [
            'choices' => [
                'Utilisateur' => 'ROLE_USER',
                'Administrateur' => 'ROLE_ADMIN'
            ],
            'expanded' => true,
            'multiple' => true,
            'label' => 'Rôles' 
        ]) 
        ->add('password',HiddenType::class,[
            'data' => 'Abcdef123456789!',
            'label' => 'Mot de passe',
            'attr' => [
                'placeholder' => 'Mot de passe ... ',
                'class' => 'form-control form-control-sm col-12'
            ]
        ])
        ->add('confirm_password',HiddenType::class,[
            'data' => 'Abcdef123456789!',
            'label' => 'Confirmation',
            'attr' => [
                'placeholder' => 'Confirmer le mot de passe',
                'class' => 'form-control form-control-sm col-12'
            ]
        ])
        ->add('departure', EntityType::class, [
            'class' => AdminDeparture::class,
            'choice_label' => function (AdminDeparture $AdminDeparture) {
                return $AdminDeparture->getTitle();
            },
            'placeholder' => 'Select',
            'label' => 'Departement',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('c')
                    ->orderBy('c.title', 'ASC');
            },
            'attr' => [
                'class' => 'form-control form-control-sm col-12',
            ],
            'required' => false,
            'empty_data' => '4',
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
            'data_class' => User::class,
        ]);
    }
}
