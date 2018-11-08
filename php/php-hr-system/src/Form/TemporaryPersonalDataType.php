<?php

namespace App\Form;

use App\Entity\TemporaryPersonalData;
use App\Form\AdresArrayType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\CallbackTransformer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class TemporaryPersonalDataType extends AbstractType
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('Timestamp')
            //->add('UserID')
            ->add('FamilyName')
            ->add('FirstName')
            ->add('BirthDate', DateType::class, array('years'=>range(date("Y")-80,date("Y"))))
            ->add('BirthPlace')
            ->add('Photo')
            ->add('adres', CollectionType::class, array('entry_type' => AdresArrayType::class))
            ->add('emails', CollectionType::class, array('entry_type' => EmailArrayType::class))
            ->add('phoneNumbers', CollectionType::class, array('entry_type' => PhoneNumbersArrayType::class))
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TemporaryPersonalData::class,
        ]);
    }
}
