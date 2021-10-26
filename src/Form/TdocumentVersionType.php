<?php

namespace App\Form;

use App\Entity\TdocumentVersion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TdocumentVersionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('intitule')
            ->add('typeDocument')
            ->add('taille')
            ->add('observation')
            ->add('dateCreation')
            ->add('userCreate')
            // ->add('document')
        ;
    }
 
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TdocumentVersion::class,
        ]);
    }
}
