<?php

namespace App\Form;
use App\Entity\PosteDeTravail;
use App\Entity\Salarie;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormTypeInterface ;



use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SalarieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matricule')
            ->add('nom')
            ->add('prenom')
            ->add('adress')
            ->add('tel')
            ->add('cin')
            ->add('N_Caisse_Nationale')

            ->add('statut')

            ->add('genre',ChoiceType::class ,['choices' => [
                'femme' => 'F',
                'Homme' => 'H',

            ]] )




            ->add('photo',FileType::class,array('label' => 'Photo: ',
                'mapped' => false
            ,'required' => false
            ))

            ->add('ID_PT',EntityType::class, [

                'class' => PosteDeTravail::class,
                'choice_label'=>Function($id){return $id ->getNom() ;

                }]   )

            ->add('date_de_naissance', DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Salarie::class,
        ]);
    }
}
