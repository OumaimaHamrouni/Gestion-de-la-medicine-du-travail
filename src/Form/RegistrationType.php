<?php


namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{ public  function buildForm(FormBuilderInterface $builder, array $options)
{$builder
    ->add('nom')
    ->add('prenom');
}

    public function getParent()
{
    return 'fos_user_registration';
}
public  function  getName(){
    return 'App_user_registration';
}



}
