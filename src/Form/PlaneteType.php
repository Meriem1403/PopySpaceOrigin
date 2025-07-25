<?php

namespace App\Form;

use App\Entity\Planete;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlaneteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom',
            ])
            ->add('description', null, [
                'label' => 'Description',
            ])
            ->add('lightYearsFromEarth', null, [
                'label' => 'Distance (années-lumière)',
            ])
            ->add('imageFilename', ChoiceType::class, [
                'label' => 'Image de la planète',
                'choices' => [
                    'Choisir une image...' => '',
                    'Planète 1' => 'planet-1.png',
                    'Planète 2' => 'planet-2.png',
                    'Planète 3' => 'planet-3.png',
                    'Planète 4' => 'planet-4.png',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Planete::class,
        ]);
    }
}
