<?php

namespace App\Form;

use App\Entity\Membership;
use App\Entity\PersonalData;
use App\Entity\Units;
use App\Form\DataTransformers\UnitNameToUnitTransformer;
use App\Form\DataTransformers\UserNameToPersonalDataTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\ORM\EntityManagerInterface;

class MembershipType extends AbstractType
{
    private $transformer;
    private $transformer2;
    private $entityManager;

    public function __construct(UnitNameToUnitTransformer $transformer, UserNameToPersonalDataTransformer $transformer2, EntityManagerInterface $entityManager)
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

        $units_choices = array();
        $units = $this->entityManager->getRepository(Units::class)->findAll();
        foreach ($units as $unit){
            $units_choices[$unit->getName()] = $unit->getName();
        }

        $builder
            ->add('WorkingHoursPerWeek')
            ->add('Person', ChoiceType::class, array('choices'=>$choices))
            ->add('Unit', ChoiceType::class, array('choices'=>$units_choices))
            //->add('Person', TextType::class)
            //->add('Unit', TextType::class)
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
