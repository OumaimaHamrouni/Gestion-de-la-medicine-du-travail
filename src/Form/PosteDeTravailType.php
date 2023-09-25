<?php

namespace App\Form;

use App\Entity\PosteDeTravail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PosteDeTravailType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('refrence')
            ->add('lieu')
            ->add('atelier')
            ->add('exigence')

            ->add('moyen_maitrise')
            ->add('horaire', ChoiceType::class, array(
                'choices' => array('jour' => 'jour', 'soir' => 'soir','nuit'=>'nuit'),
                'expanded' => true,
                'multiple' => false,
                //  'choices_as_values' => true,
                'label'=>false,
            ))
            ->add('equipement',ChoiceType::class, array(
                'choices' => array('Equipement de protection individuelle  '=>' Equipement de protection individuelle   ',"Outils de travail  "=>'Outils de travail ',"Equipements de travail(échelle,etc)  "=>'Equipements de travail(échelle,etc) '),
                'expanded' => false,
                'multiple' => true,
                //  'choices_as_values' => true,
                'label'=>false,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PosteDeTravail::class,
        ]);
    }
}
