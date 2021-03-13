<?php

namespace App\Form;

use App\Entity\Responsable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResponsableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('anneeScolaire')
            ->add('user')
            ->add('ecole')
            ->add('departement')
            ->add('pole')
            ->add('mention')
            ->add('parcours')
            ->add('promotion')
            ->add('modules')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Responsable::class,
        ]);
    }
}
