<?php

namespace App\Form;

use App\Entity\AgentService;
use App\Entity\Commune;
use App\Entity\FormationSanitaire;
use App\Entity\ServiceOffert;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormationSanitaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_FS', TextType::class,[
                "label"=>"Nom formation",
                'attr'=>['class'=>'form-control mb-3'
                    ]
            ])
            ->add('typy_FS',
                TextType::class,[
                    "label"=>"Type du formation",
                    'attr'=>['class'=>'form-control mb-3'
                    ]
                ])
            ->add('adress_FS',TextType::class,[
                "label"=>"Address",
                'attr'=>['class'=>'form-control mb-3'
                ]
            ])
            ->add('coordonner_FS',TextType::class,[
                "label"=>"Coordonnee du formation",
                'attr'=>['class'=>'form-control mb-3'
                ]
            ])
            ->add('status',CheckboxType::class,[
                "label"=>"Status"
            ])
            ->add('serv',EntityType::class,[
                'class'=>ServiceOffert::class,
                'choice_label'=>'libelle_offre',
                'label'=>'type d\'offre',
                'attr'=>['class'=>'form-select mb-3'],
                'label_attr'=>['class'=>'mb-3']

            ])
            ->add('agentService',EntityType::class,[
                'class'=>AgentService::class,
                'choice_label'=>'type_s',
                'label'=>'type de l\' agent',
                'attr'=>['class'=>'form-select mb-3'],
                'label_attr'=>['class'=>'mb-3']

            ])
            ->add('Commune',EntityType::class,[
                'class'=>Commune::class,
                'choice_label'=>'libelle_commune',
                'label'=>'Nom du commune',
                'attr'=>['class'=>'form-select mb-3'],
                'label_attr'=>['class'=>'mb-3']

            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FormationSanitaire::class,
        ]);
    }
}
