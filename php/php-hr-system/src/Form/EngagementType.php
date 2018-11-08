<?php

namespace App\Form;

use App\Entity\Engagement;
use App\Entity\StaffCategory;
use App\Entity\PersonalData;
use App\Form\DataTransformers\StaffCategoryNameToStaffCategoryTransformer;
use App\Form\DataTransformers\UserNameToPersonalDataTransformer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EngagementType extends AbstractType
{

    private $transformer;
    private $transformer2;
    private $entityManager;

    public function __construct(StaffCategoryNameToStaffCategoryTransformer $transformer, UserNameToPersonalDataTransformer $transformer2, EntityManagerInterface $entityManager)
    {
        $this->transformer = $transformer;
        $this->transformer2 = $transformer2;
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choices = array();
        $people = $this->entityManager->getRepository(PersonalData::class)->findAll();
        foreach ($people as $person){
            $choices[$person->getFamilyName()." ".$person->getFirstName()] = $person->getUserID()->getUsername();
        }

        $category_choices = array();
        $categories = $this->entityManager->getRepository(StaffCategory::class)->findAll();
        foreach ($categories as $category){
            $category_choices[$category->getName()] = $category->getName();
        }

        $builder
            ->add('StaffCategory' , ChoiceType::class, array('choices'=>$category_choices))
            ->add('Person', ChoiceType::class, array('choices'=>$choices))
            //->add('StaffCategory', TextType::class)
            //->add('Person', TextType::class)
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
