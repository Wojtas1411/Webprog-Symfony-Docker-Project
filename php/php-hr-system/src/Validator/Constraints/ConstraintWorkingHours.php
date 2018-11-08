<?php
/**
 * Created by PhpStorm.
 * User: wojtek
 * Date: 08.11.18
 * Time: 13:53
 */
namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ConstraintWorkingHours extends Constraint
{
    public $message = 'The number of working hours it too high.';

    public function validatedBy()
    {
        return \get_class($this).'Validator';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

}