<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Service;
use App\Entity\ListeTache;
use App\Entity\NomListeTache;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ListeTacheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
        ->add('submit',SubmitType::class,[
            'label' => 'Ajouter',
            'attr' => [
                'class' => 'btn btn-success btn-sm col-2'
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ListeTache::class,
        ]);
    }
}
