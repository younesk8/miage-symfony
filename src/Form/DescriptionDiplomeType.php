<?php

namespace App\Form;

use App\Entity\DescriptionDiplome;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DescriptionDiplomeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descriptionBref')
            ->add('publicConcerne')
            ->add('fichePDF')
            ->add('preRequis')
            ->add('modaliteInscription')
            ->add('tarif')
            ->add('competences')
            ->add('poursuiteEtude')
            ->add('deboucherPro')
            ->add('contact')
            ->add('atouts')
            ->add('mention')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DescriptionDiplome::class,
        ]);
    }
}
