<?php

namespace App\Form;

use App\Entity\JobData;
use App\Entity\PersonalData;
use App\Form\DataTransformers\UserNameToPersonalDataTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class JobDataType extends AbstractType
{
    private $transformer;
    private $entityManager;

    public function __construct(UserNameToPersonalDataTransformer $transformer, EntityManagerInterface $entityManager)
    {
        $this->transformer = $transformer;
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choices = array();
        $people = $this->entityManager->getRepository(PersonalData::class)->findAll();
        foreach ($people as $person){
            if( $person->getJobData() === null){
                $choices[$person->getFamilyName()." ".$person->getFirstName()] = $person->getUserID()->getUsername();
            }
        }

        $builder
            ->add('StartContract')
            ->add('EndContract')
            ->add('MonthlySalary')
            ->add('WorkingHoursPerWeek')
            ->add('BankInfo')
            ->add('BankAccountNumber')
            ->add('User', ChoiceType::class, array('choices' => $choices))
            //->add('User', TextType::class)
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
