<?php

namespace App\Form;

use App\Entity\Actualite;
use App\Entity\AgentService;
use App\Entity\Document;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgentServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type_S',TextType::class,[
                "label"=>'nom de agent',
                'attr'=>['class'=>'form-control']
            ])
            ->add('actualite',EntityType::class,[
                'class'=>Actualite::class,
                'choice_label'=>'description',
                'label'=>'Actualite',
                'attr'=>['class'=>'form-select mb-3'],
                'label_attr'=>['class'=>'mb-3']
            ])
            ->add('document',EntityType::class,[
                'class'=>Document::class,
                'choice_label'=>'nomdoc',
                'label'=>'Document',
                'attr'=>['class'=>'form-select mb-3'],
                'label_attr'=>['class'=>'mb-3']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AgentService::class,
        ]);
    }
}
