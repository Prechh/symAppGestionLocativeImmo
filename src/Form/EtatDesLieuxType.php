<?php

namespace App\Form;

use App\Entity\EtatDesLieux;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class EtatDesLieuxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateEnter', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => ' Date entrée :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('dateExit', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Date sortie :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],

            ])

            ->add('propertyType', ChoiceType::class, [
                'choices' => [
                    'Appartement ' => 'Appartement',
                    'Maison' => 'Maison',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Type de propriétée :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('surface', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Surface :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('numberMainRooms', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Nombre de pièces principales :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])


            ->add('fullAdress', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Adresse complète :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('fullnameLessor', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Nom complet Bailleur :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('fullAdressLessor', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Adresse complète du Bailleur  :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('fullnameTenant', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Nom complet Locataire :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('fullAdressTenant', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Adresse complète du locataire :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('numberCounterElec', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Numéros du compteur électrique :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('numberCounterGaz', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Numéros du compteur Gaz :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('cubicMeterColdWater', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Nombre m3 d\'eau froide :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('cubicMeterHotWater', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Nombre m3 d\'eau chaude  :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('nameFormerTenant', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Nom de l\'ancien occupant',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('heatingType', ChoiceType::class, [
                'choices' => [
                    'Electrique' => 'Electrique',
                    'Gaz' => 'Gaz',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Type de chauffage :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('hotWaterType', ChoiceType::class, [
                'choices' => [
                    'Electrique' => 'Electrique',
                    'Gaz' => 'Gaz',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Type de chauffage eau :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('stateBoiler', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Etat de la chaudière :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('numberWaterRadiator', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Nombre de radiateur d\'eau :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('numberElecRadiator', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Nombre de radiateur électrique ',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('observation', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Observation  :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('Tenant')
            ->add('Property')


            ->add('Submit', SubmitType::class, [
                'attr' => [
                    "class" => 'btn btn-success mt-5',
                ],
                'label' => 'Envoyer l\'état des lieux',

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EtatDesLieux::class,
        ]);
    }
}
