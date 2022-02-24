<?php

namespace App\Form;

use App\Entity\Manuel;
use App\Entity\Category;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ManuelType extends AbstractType
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
        ->add('text',CKEditorType::class,[
            'label' => 'Contenu',
            'attr' => [
                'rows' => '25',
                'class' => 'form-control form-control-sm col-12'
            ]
        ])
        ->add('categorie1', EntityType::class, [
            'class' => Category::class,
            'choice_label' => function (Category $category) {
                return $category->getTitle();
            },
            'placeholder' => 'Select',
            'label' => 'Catégorie 1',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('c')
                    ->orderBy('c.title', 'ASC');
            },
            'attr' => [
                'class' => 'form-control form-control-sm col-12',
            ],
            'required' => false,
        ])
        ->add('categorie2', EntityType::class, [
            'class' => Category::class,
            'choice_label' => function (Category $category) {
                return $category->getTitle();
            },
            'placeholder' => 'Select',
            'label' => 'Catégorie 2',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('c')
                    ->orderBy('c.title', 'ASC');
            },
            'attr' => [
                'class' => 'form-control form-control-sm col-12',
            ],
            'required' => false,
        ])
        ->add('categorie3', EntityType::class, [
            'class' => Category::class,
            'choice_label' => function (Category $category) {
                return $category->getTitle();
            },
            'placeholder' => 'Select',
            'label' => 'Catégorie 3',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('c')
                    ->orderBy('c.title', 'ASC');
            },
            'attr' => [
                'class' => 'form-control form-control-sm col-12',
            ],
            'required' => false,
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
            'data_class' => Manuel::class,
        ]);
    }
}
