<?php
// src/Form/PlaneteType.php
namespace App\Form;

use App\Entity\Planete;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlaneteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', null, [
                'label' => 'Nom de la planète',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr'  => ['rows' => 5],
            ])
            ->add('distanceLumiereTerre', NumberType::class, [
                'label' => 'Distance (années‑lumière)',
                'scale' => 2,
            ])
            ->add('image', ChoiceType::class, [
                'label'       => 'Image de la planète',
                'choices'     => [
                    'Planète 1' => 'planet-1.png',
                    'Planète 2' => 'planet-2.png',
                    'Planète 3' => 'planet-3.png',
                    'Planète 4' => 'planet-4.png',
                ],
                'placeholder' => '— Choisir une image —',
                'expanded'    => true,   // radios
                'multiple'    => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Planete::class,
        ]);
    }
}
