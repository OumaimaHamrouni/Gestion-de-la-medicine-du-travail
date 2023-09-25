<?php

namespace App\Form;

use App\Entity\Observation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class ObservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('observation')
            ->add('remarque')

            ->add('exemen_comp',ChoiceType::class, array(
                'choices' => array('Examen physique'=>'Examen physique',"Examen clinique "=>'Examen clinique',"Examen para clinique"=>'Examen para clinique ','Examen psychiatrique'=>'Examen psychiatrique',"examen medicale typique"=>'Examen edicale typique',"Examen en neurologie"=>'Examen en neurologie'),
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
            'data_class' => Observation::class,
        ]);
    }
}
