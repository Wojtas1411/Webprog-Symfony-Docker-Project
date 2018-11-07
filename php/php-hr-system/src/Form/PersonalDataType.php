<?php

namespace App\Form;

use App\Entity\PersonalData;
use App\Form\DataTransformers\UserNameToUserTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class PersonalDataType extends AbstractType
{

    private $transformer;

    public function __construct(UserNameToUserTransformer $transformer)
    {
        $this->transformer = $transformer;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('FamilyName')
            ->add('FirstName')
            ->add('BirthDate', DateType::class, array('years'=>range(date("Y")-80,date("Y"))))
            ->add('BirthPlace')
            ->add('Photo')
            ->add('UserID', TextType::class)
        ;

        $builder->get('UserID')->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PersonalData::class,
        ]);
    }
}
