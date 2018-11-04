<?php

namespace App\Form;

use App\Entity\JobData;
use App\Form\DataTransformers\UserNameToPersonalDataTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobDataType extends AbstractType
{
    private $transformer;

    public function __construct(UserNameToPersonalDataTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('StartContract')
            ->add('EndContract')
            ->add('MonthlySalary')
            ->add('WorkingHoursPerWeek')
            ->add('BankInfo')
            ->add('BankAccountNumber')
            ->add('User', TextType::class)
        ;

        $builder->get('User')->addModelTransformer($this->transformer);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => JobData::class,
        ]);
    }
}
