<?php

namespace App\Form;

use App\Entity\UserSemestre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserSemestreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('asAjac')
            ->add('asValide')
            ->add('promotion')
            ->add('etudiant')
            ->add('annee')
            ->add('semestre')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserSemestre::class,
        ]);
    }
}
