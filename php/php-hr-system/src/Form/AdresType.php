<?php

namespace App\Form;

use App\Entity\Adres;
use App\Form\DataTransformers\UserNameToPersonalDataTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresType extends AbstractType
{
    private $transformer;

    public function __construct(UserNameToPersonalDataTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prim')
            ->add('Street')
            ->add('Number')
            ->add('Local')
            ->add('PostalCode')
            ->add('Town')
            ->add('User', TextType::class)
        ;

        $builder->get('User')->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adres::class,
        ]);
    }
}