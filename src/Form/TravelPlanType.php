<?php

namespace App\Form;

use App\Entity\TravelPlan;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TravelPlanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('country')
            ->add('date', null, [
                'widget' => 'single_text',
            ])
            ->add('morning')
            ->add('noon')
            ->add('afternoon')
            ->add('evening')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TravelPlan::class,
        ]);
    }

}
