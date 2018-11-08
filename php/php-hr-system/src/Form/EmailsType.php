<?php

namespace App\Form;

use App\Entity\Emails;
use App\Form\DataTransformers\UserNameToPersonalDataTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\PersonalData;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EmailsType extends AbstractType
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
            $choices[$person->getFamilyName()." ".$person->getFirstName()] = $person->getUserID()->getUsername();
        }

        $builder
            ->add('prim')
            ->add('Value')
            ->add('User', ChoiceType::class, array('choices' => $choices))
            //->add('User', TextType::class)
        ;

        $builder->get('User')->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Emails::class,
        ]);
    }
}
