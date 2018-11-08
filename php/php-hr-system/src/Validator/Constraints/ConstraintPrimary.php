<?php
/**
 * Created by PhpStorm.
 * User: wojtek
 * Date: 08.11.18
 * Time: 14:45
 */

namespace App\Validator\Constraints;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */

class ConstraintPrimary extends Constraint
{
    public $message = 'You can have only one primary {{ string }}.';

    public function validatedBy()
    {
        return \get_class($this).'Validator';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}