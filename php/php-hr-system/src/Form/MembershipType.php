<?php

namespace App\Form;

use App\Entity\Membership;
use App\Form\DataTransformers\UnitNameToUnitTransformer;
use App\Form\DataTransformers\UserNameToPersonalDataTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MembershipType extends AbstractType
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
            ->add('WorkingHoursPerWeek')
            ->add('Person', TextType::class)
            ->add('Unit', TextType::class)
        ;

        $builder->get('Unit')->addModelTransformer($this->transformer);
        $builder->get('Person')->addModelTransformer($this->transformer2);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Membership::class,
        ]);
    }
}
