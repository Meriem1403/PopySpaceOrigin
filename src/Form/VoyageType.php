<?php

namespace App\Form;

use App\Entity\Voyage;
use App\Entity\Planete;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfonycasts\DynamicForms\DependentField;
use Symfonycasts\DynamicForms\DynamicFormBuilder;

class VoyageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // On wrappe le builder pour gérer le champ conditionnel
        $builder = new DynamicFormBuilder($builder);

        $builder
            ->add('objectif', TextType::class, [
                'label' => 'Objectif du voyage',
            ])
            ->add('depart', DateType::class, [
                'label'  => 'Date de départ',
                'widget' => 'single_text',
                'attr'   => [
                    'data-controller' => 'datepicker',
                ],
            ])
            ->add('planete', EntityType::class, [
                'label'        => 'Planète',
                'class'        => Planete::class,
                'choice_label' => 'nom',
                'placeholder'  => 'Choisir une planète',
                'attr'         => ['class' => 'tom-select'], // ✅ important pour que Tom Select s'active
            ])
            ->addDependent('upgradeTrouDeVer', ['planete'], function (DependentField $field, ?Planete $planete) {
                if (!$planete || $planete->isDansVoieLactee()) {
                    return;
                }

                $field->add(ChoiceType::class, [
                    'label'    => 'Améliorer le trou de ver ?',
                    'choices'  => [
                        'Oui' => true,
                        'Non' => false,
                    ],
                    'expanded' => true,
                    'multiple' => false,
                ]);
            });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voyage::class,
        ]);
    }
}
