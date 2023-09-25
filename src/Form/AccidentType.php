<?php

namespace App\Form;

use App\Entity\Accident;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Salarie;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
class AccidentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('cause',TextareaType::class)
            ->add('description',TextareaType::class)
            ->add('dateheure_accident', DateTimeType::class,['widget' => 'single_text'])
            ->add('ref')
            ->add('lieu')
            ->add('etablissement',ChoiceType::class, array(
                'choices' => array('chantier'=>'chantier',"Atelier "=>'Atelier',"bureau"=>'bureau',"Autre"=>'Autre'),
                'expanded' => false,
                'multiple' => false,
                //  'choices_as_values' => true,
                'label'=>false,
            ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Accident::class,
        ]);
    }
}
