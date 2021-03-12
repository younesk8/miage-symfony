<?php

namespace App\Form;

use App\Entity\InscriptionSemestre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionSemestreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('anneeScolaire')
            ->add('asTierTemp')
            ->add('asRSE')
            ->add('asValide')
            ->add('asTransmise')
            ->add('messageProf')
            ->add('regime')
            ->add('etudiant')
            ->add('secretaire')
            ->add('enseignant')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InscriptionSemestre::class,
        ]);
    }
}
