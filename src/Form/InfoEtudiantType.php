<?php

namespace App\Form;

use App\Entity\InfoEtudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InfoEtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numEtu')
            ->add('regimeSpecial')
            ->add('adresseEtu')
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InfoEtudiant::class,
        ]);
    }
}
