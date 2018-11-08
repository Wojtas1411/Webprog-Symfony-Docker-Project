<?php

namespace App\Form;

use App\Entity\PersonalData;
use App\Entity\User;
use App\Form\DataTransformers\UserNameToUserTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PersonalDataType extends AbstractType
{

    private $transformer;
    private $entityManager;

    public function __construct(UserNameToUserTransformer $transformer, EntityManagerInterface $entityManager)
    {
        $this->transformer = $transformer;
        $this->entityManager = $entityManager;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choices = array();
        $people = $this->entityManager->getRepository(User::class)->findAll();
        foreach ($people as $person){
            if ($person->getPersonalData() === null && $person->getUsername() != "admin"){
                $choices[$person->getUsername()] = $person->getUsername();
            }
        }
        $builder
            ->add('FamilyName')
            ->add('FirstName')
            ->add('BirthDate', DateType::class, array('years'=>range(date("Y")-80,date("Y"))))
            ->add('BirthPlace')
            ->add('Photo')
            ->add("UserID", ChoiceType::class, array('choices' => $choices))
            //->add('UserID', TextType::class)
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
