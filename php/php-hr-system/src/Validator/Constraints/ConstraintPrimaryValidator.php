<?php
/**
 * Created by PhpStorm.
 * User: wojtek
 * Date: 08.11.18
 * Time: 14:49
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Adres;
use App\Entity\Emails;
use App\Entity\PhoneNumbers;

class ConstraintPrimaryValidator extends ConstraintValidator
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    public function validate($value, Constraint $constraint){
        // custom constraints should ignore null and empty values to allow
        // other constraints (NotBlank, NotNull, etc.) take care of that
        if (null === $value || '' === $value) {
            return;
        }

        $class_name = "";

        if(get_class($value) == Adres::class){
            $class_name = "Address";
        } elseif (get_class($value) == Emails::class){
            $class_name = "Email";
        } elseif (get_class($value) == PhoneNumbers::class){
            $class_name = "Phone Number";
        } else {
            $class_name = "Thing";
        }

        $things = $this->entityManager->getRepository(get_class($value))->findBy(array('User'=>$value->getUser()));

        $primary = false;

        foreach ($things as $thing){
            if($thing->getPrim()){
                $primary = true;
                break;
            }
        }

        if($primary && $value->getPrim()){
            $this->context->buildViolation("Primary ".$class_name." already exists for this Person")->addViolation();
        }

        if(!$primary && !$value->getPrim()){
            $this->context->buildViolation("First create primary ".$class_name." for this Person")->addViolation();
        }
    }
}