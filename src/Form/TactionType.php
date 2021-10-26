<?php

namespace App\Form;

use App\Entity\Taction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TactionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('RefAction')
            ->add('intitule')
            ->add('Taction')
            ->add('etatUrgence')
            // ->add('dateCreation')
            // ->add('userCreate')
            // ->add('active')
            // ->add('cloturer')
            // ->add('urgence')
        ;
    }
 
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Taction::class,
        ]);
    }
}
