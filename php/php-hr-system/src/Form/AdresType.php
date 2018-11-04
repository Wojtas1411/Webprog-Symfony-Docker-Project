<?php

namespace App\Form;

use App\Entity\Adres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prim')
            ->add('Street')
            ->add('Number')
            ->add('Local')
            ->add('PostalCode')
            ->add('Town')
            ->add('User')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adres::class,
        ]);
    }
}
