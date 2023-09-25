<?php

namespace App\Form;
use App\Entity\Accident;
use App\Entity\Salarie;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Enquette;

use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnquetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('indice')

            ->add('id_s',EntityType::class, [

                'class' => Salarie::class,
                'choice_label'=>Function($id){return $id ->getMatricule() ;

                }]   )

            ->add('date_arret', DateTimeType::class,['widget' => 'single_text'])

            ->add('dateheure_declaration', DateType::class, [
                // renders it as a single text box
                'widget' => 'single_text',
            ])
            ->add('date_prevue', DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
            ])
            ->add('premier_soins',ChoiceType::class, array(
                'choices' => array('Oui'=>'oui',"Non"=>'Non'),
                'expanded' => true,
                'multiple' => false,
                //  'choices_as_values' => true,
                'label'=>false,
            ))




            ->add('date_premier_soins', DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
            ])


            ->add('organisation',ChoiceType::class, array(
                'choices' => array('   Procédures de travail   '=>'   Procédures de travail  ',"Formation "=>'Formation ',"Horaire de travail  "=>'Horaire de travail  ',"Trasport (accident de route)
  "=>'Trasport (accident de route)  '),
                'expanded' => false,
                'multiple' => true,
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
            ->add('environnement',ChoiceType::class, array(
                'choices' => array('Ergonomie du poste  '=>'Ergonomie du poste  ',"Lay out du poste"=>'Lay out du poste',"Eclairage non adapté  "=>'Eclairage non adapté  ', "Bruit"=>'Bruit ' ,"Produits dangereux "=>'Produits dangereux  ',"Autres "=>'Autres '),
                'expanded' => false,
                'multiple' => true,
                //  'choices_as_values' => true,
                'label'=>false,
            ))
            ->add('nature_lesion',ChoiceType::class, array(
                'choices' => array('Coupure'=>' Coupure ',  "Ecorchure"=>'Ecorchure',"Brûlure  "=>'Brûlure ',"Enflure"=>'Enflure',"Fracture"=>'Fracture',"Amputaion"=>'Amputaion',"Entorse"=>'Entorse',"Luxation "=>'Luxation ',"Déchirure musculaire"=>'Déchirure musculaire ',"Ecorchure"=>'Ecorchure',"Lombalgie"=>'Lombalgie ',"Douleur "=>'Douleur ',"Hernie "=>'Hernie',"Asphyxie "=>'Asphyxie ',"Autres (à préciser) "=>'Autres (à préciser) '),
                'expanded' => false,
                'multiple' => true,
                //  'choices_as_values' => true,
                'label'=>false,
            ))
            ->add('siege_lesion',ChoiceType::class, array(
                'choices' => array('tête '=>' tête ',  "Dos"=>'Dos',"Main"=>'Main',"Pied"=>'Pied',"cou et gorge"=>'cou et gorge',"Poitrine"=>'Poitrine',"Bassin"=>'Bassin',"Genou"=>'Genou '),
                'expanded' => false ,
                'multiple' => true,
                //  'choices_as_values' => true,
                'label'=>true ,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Enquette::class,
        ]);
    }
}
