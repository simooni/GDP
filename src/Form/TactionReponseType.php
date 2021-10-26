<?php

namespace App\Form;

use App\Entity\TactionReponse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TactionReponseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('refReponse')
            ->add('intitule')
            // ->add('typeReponse')
            // ->add('dateCreation')
            // ->add('dateCreationn')
            // ->add('userCreate')
            // ->add('taction')
            // ->add('document')
            ->add('observation')
        ;
    }
 
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TactionReponse::class,
        ]);
    }
}
