<?php

namespace App\Form;

use App\Entity\District;
use App\Entity\Region;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DistrictType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle_district',TextType::class,[
                "label"=>"nom district",
                'attr'=>['class'=>'form-control mb-3']
            ])
            ->add('Region',EntityType::class,[
                'class'=>Region::class,
                'choice_label'=> 'libelle_region',
                'label'=>'select region',
                'attr'=>['class'=>'form-select mb-3'],
                'label_attr'=>['class'=>'mb-1']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => District::class,
        ]);
    }
}
