<?php

namespace App\Form;

use App\Entity\PersonalData;
use App\Entity\Units;
use App\Repository\UnitsRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\DataTransformers\UnitNameToUnitTransformer;
use App\Form\DataTransformers\UserNameToPersonalDataTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\ORM\EntityManagerInterface;

class UnitsType extends AbstractType
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
        $faculty_choices = array();
        $faculty_choices["None"] = "None";
        $units = $this->entityManager->getRepository(Units::class)->findBy(['Parent'=> null]);
        foreach ($units as $unit){
            $faculty_choices[$unit->getName()] = $unit->getName();
        }

        $boss_choices = array();
        $people = $this->entityManager->getRepository(PersonalData::class)->findAll();
        foreach ($people as $person){
            $boss_choices[$person->getFamilyName()." ".$person->getFirstName()] = $person->getUserID()->getUsername();
        }

        $builder
            ->add('name')
            ->add('type', ChoiceType::class, array('choices' => array('Faculty'=>"Faculty", "Research unit"=>"Research")))
            ->add('Parent', ChoiceType::class, array('choices' => $faculty_choices))
            ->add('Boss', ChoiceType::class, array('choices' => $boss_choices))
            //->add('Parent', TextType::class)
            //->add('Boss', TextType::class)
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
