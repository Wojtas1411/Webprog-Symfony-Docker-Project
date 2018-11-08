<?php

namespace App\Form;

use App\Entity\Adres;
use App\Entity\PersonalData;
use App\Form\DataTransformers\UserNameToPersonalDataTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\ORM\EntityManagerInterface;

class AdresType extends AbstractType
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
            ->add('Street')
            ->add('Number')
            ->add('Local')
            ->add('PostalCode')
            ->add('Town')
            ->add('User', ChoiceType::class, array('choices' => $choices))
            //->add('User', TextType::class)
        ;

        $builder->get('User')->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adres::class,
        ]);
    }
}
