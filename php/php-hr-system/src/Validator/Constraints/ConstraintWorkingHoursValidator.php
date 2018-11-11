<?php
/**
 * Created by PhpStorm.
 * User: wojtek
 * Date: 08.11.18
 * Time: 13:55
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Membership;
use App\Entity\PersonalData;

class ConstraintWorkingHoursValidator extends ConstraintValidator
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

        $person = $value->getPerson();

        $all_memberships = $this->entityManager->getRepository(Membership::class)->findBy(array('Person'=>$person));

        $sum = 0;
        foreach ($all_memberships as $membership){
            $sum += $membership->getWorkingHoursPerWeek();
        }

        if($person->getJobData() === null){
            $this->context->buildViolation("Job data for this Person does not exist")->addViolation();
            return;
        }

        $contract_hours = $person->getJobData()->getWorkingHoursPerWeek();

        if($sum + $value->getWorkingHoursPerWeek()> $contract_hours){
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}