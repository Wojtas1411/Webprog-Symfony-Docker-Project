<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\CallbackTransformer;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choices = array("USER"=>"ROLE_USER", "ADMIN"=>"ROLE_ADMIN", "HR DEPARTMENT"=>"ROLE_HR");
        //->add('roles', CollectionType::class, array('entry_type' => TextType::class))
        $builder
            ->add('username')
            ->add('roles', ChoiceType::class, array('choices'=>$choices, 'multiple'=>true, 'expanded'=>true))
            //->add('roles', TextType::class)
            ->add('password');

//        $builder->get('roles')
//            ->addModelTransformer(new CallbackTransformer(
//                function ($tagsAsArray) {
//                    // transform the array to a string
//                    return implode(', ', $tagsAsArray);
//                    },
//                function ($tagsAsString) {
//                    // transform the string back to an array
//                    return explode(', ', $tagsAsString);
//                }
//                ))
//            ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
