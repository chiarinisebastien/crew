<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Service;
use App\Entity\Yesorno;
use App\Entity\Intervention;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class InterventionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
        ->add('agent', EntityType::class, [
            'class' => User::class,
            'choice_label' => function (User $user) {
                return $user->getFirstname() . ' ' . $user->getLastname();
            },
            'placeholder' => 'Select',
            'label' => 'Agent',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('c')
                    ->orderBy('c.lastname', 'ASC');
            },
            'attr' => [
                'class' => 'form-control form-control-sm col-12',
            ],
            'required' => false,
            'empty_data' => '2',
        ])
        ->add('service', EntityType::class, [
            'class' => Service::class,
            'choice_label' => function (Service $service) {
                return $service->getTitle();
            },
            'placeholder' => 'Select',
            'label' => 'Service',
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
        ->add('origine', EntityType::class, [
            'class' => Yesorno::class,
            'choice_label' => function (Yesorno $title) {
                return $title->getTitle();
            },
            'required' => true,
            'placeholder' => false,
            'label' => 'Nouvelle demande',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('c')
                    ->orderBy('c.id', 'desc');
            },
            'attr' => [
                'class' => 'form-control form-control-sm col-12',
            ],
        ])
        ->add('createdAt',DateTimeType::class,[
            'label' => 'Ouverture',
            'widget' => 'single_text',
            'required' => false,
            'attr' => [
                'class' => 'form-control form-control-sm col-12',
            ],
        ])
        ->add('clotureAt',DateTimeType::class,[
            'label' => 'Fermeture',
            'widget' => 'single_text',
            'required' => false,
            'attr' => [
                'class' => 'form-control form-control-sm col-12',
            ],
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
            'data_class' => Intervention::class,
        ]);
    }
}
