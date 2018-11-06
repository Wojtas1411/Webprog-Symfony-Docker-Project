<?php

namespace App\Form;

use App\Entity\Units;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\DataTransformers\UnitNameToUnitTransformer;
use App\Form\DataTransformers\UserNameToPersonalDataTransformer;

class UnitsType extends AbstractType
{
    private $transformer;
    private $transformer2;

    public function __construct(UnitNameToUnitTransformer $transformer, UserNameToPersonalDataTransformer $transformer2)
    {
        $this->transformer = $transformer;
        $this->transformer2 = $transformer2;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('type')
            ->add('Parent', TextType::class)
            ->add('Boss', TextType::class)
        ;
        $builder->get('Parent')->addModelTransformer($this->transformer);
        $builder->get('Boss')->addModelTransformer($this->transformer2);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Units::class,
        ]);
    }
}
