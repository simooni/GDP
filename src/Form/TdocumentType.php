<?php

namespace App\Form;

use App\Entity\Tdocument;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TdocumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('intitule')
            // ->add('typeDocument')
            // ->add('taille')
            // ->add('dateCreation')
            // ->add('userCreate')
            // ->add('active')
            // ->add('cloturer')
            // ->add('statut')
            ->add('avancement')
        ;
    }
 
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tdocument::class,
        ]);
    }
}
