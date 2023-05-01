<?php

namespace App\Form;

use App\Entity\Property;
use App\Entity\Tenant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Validator\Constraints as Assert;

class TenantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Nom :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('firstname', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Prénom :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('account_balance', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Solde du compte :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => []
            ])

            ->add('payment_type', ChoiceType::class, [
                'choices' => [
                    'Par le locataire ' => 'Par le locataire',
                    'Par caisse d\'allocation familiale' => 'Par caisse d\'allocation familiale',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Type de paiment  :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

            ->add('monthly_rate', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Salaire du locataire :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => []
            ])

            ->add('Submit', SubmitType::class, [
                'attr' => [
                    "class" => 'btn btn-success mt-5',
                ],
                'label' => 'Ajouter le locataire',

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tenant::class,
        ]);
    }
}
