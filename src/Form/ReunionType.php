<?php

namespace App\Form;

use App\Entity\Reunion;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ReunionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('createdAt',DateTimeType::class,[
            'label' => 'Date',
            'widget' => 'single_text',
            'required' => false,
            'attr' => [
                'class' => 'form-control form-control-sm col-12',
            ],
        ])
        ->add('title',null,[
            'label' => 'Titre',
            'attr' => [
                'placeholder' => 'titre...',
                'class' => 'form-control form-control-sm col-12'
            ],
            'required'=>true,
        ])
        ->add('text',CKEditorType::class,[
            'label' => 'Contenu',
            'attr' => [
                'rows' => '25',
                'class' => 'form-control form-control-sm col-12'
            ]
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
            'data_class' => Reunion::class,
        ]);
    }
}
