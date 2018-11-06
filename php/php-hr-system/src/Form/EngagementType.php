<?php

namespace App\Form;

use App\Entity\Engagement;
use App\Form\DataTransformers\StaffCategoryNameToStaffCategoryTransformer;
use App\Form\DataTransformers\UserNameToPersonalDataTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EngagementType extends AbstractType
{

    private $transformer;
    private $transformer2;

    public function __construct(StaffCategoryNameToStaffCategoryTransformer $transformer, UserNameToPersonalDataTransformer $transformer2)
    {
        $this->transformer = $transformer;
        $this->transformer2 = $transformer2;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('StaffCategory', TextType::class)
            ->add('Person', TextType::class)
        ;

        $builder->get('StaffCategory')->addModelTransformer($this->transformer);
        $builder->get('Person')->addModelTransformer($this->transformer2);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Engagement::class,
        ]);
    }
}
