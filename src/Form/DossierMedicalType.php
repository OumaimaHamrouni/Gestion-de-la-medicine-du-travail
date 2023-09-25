<?php

namespace App\Form;

use App\Entity\DossierMedical;
use App\Entity\Salarie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DossierMedicalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('allergies')
            ->add('description_allergies',TextareaType::class)
            ->add('vaccinin')
            ->add('description_vaccinin',TextareaType::class)
            ->add('taille')
            ->add('poids')
            ->add('tratitements_longues_duree')
            ->add('frequence')
            ->add('ID_S', EntityType::class, [
'class' => Salarie::class,
'choice_label' => 'matricule',
])
->add('habitude');
}

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DossierMedical::class,
        ]);
    }
}
