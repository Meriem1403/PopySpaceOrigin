<?php

namespace App\Form;

use App\Entity\Planete;
use App\Entity\Voyage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use SymfonyCasts\DynamicForms\DependentField;
use SymfonyCasts\DynamicForms\DynamicFormBuilder;

class VoyageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder = new DynamicFormBuilder($builder);

        $builder
            ->add('purpose', null, [
                'label' => 'Objet du voyage',
            ])
            ->add('leaveAt', DateType::class, [
                'label' => 'Date de départ',
                'widget' => 'single_text',
                'attr' => [
                    'data-controller' => 'datepicker',
                ],
            ])
            ->add('planet', null, [
                'label' => 'Planète de destination',
                'choice_label' => 'name',
                'placeholder' => 'Sélectionner une planète',
            ])
            ->addDependent('wormholeUpgrade', ['planet'], function (DependentField $field, ?Planete $planet) {
                if (!$planet || $planet->isInMilkyWay()) {
                    return;
                }

                $field->add(ChoiceType::class, [
                    'label' => 'Amélioration tunnel de ver',
                    'choices' => [
                        'Oui' => true,
                        'Non' => false,
                    ],
                    'placeholder' => 'Souhaitez-vous l’activer ?',
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
