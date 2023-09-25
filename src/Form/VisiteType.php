<?php

namespace App\Form;

use App\Entity\DossierMedical;
use App\Entity\Observation;
use App\Entity\Visite;
use App\Entity\Salarie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class VisiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'data' => new \DateTime(),
                'attr' => array('class' => 'form-control', 'style' => 'line-height: 20px;')
            ))




            ->add('date_prochaine', DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
            ])
            ->add('aptitude')

            ->add('salarie', EntityType::class, [
                'class' => Salarie::class,
                'choice_label' => 'matricule',
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Visite::class,
        ]);

    }








}

