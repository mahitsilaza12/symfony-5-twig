<?php

namespace App\Form;

use App\Entity\Commune;
use App\Entity\District;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommuneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle_commune',TextType::class,[
                'label'=>"nom du commune",
                'attr'=>['class'=>'form-control mb-3']
            ])
            ->add('District',EntityType::class,[
                'class'=>District::class,
                'choice_label'=> 'libelle_district',
                'label'=>'select district',
                'attr'=>['class'=>'form-select mb-3'],
                'label_attr'=>['class'=>'mb-1']

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commune::class,
        ]);
    }
}
