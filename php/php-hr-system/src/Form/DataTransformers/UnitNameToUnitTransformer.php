<?php
/**
 * Created by PhpStorm.
 * User: wojtek
 * Date: 06.11.18
 * Time: 10:46
 */

namespace App\Form\DataTransformers;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use App\Entity\Units;

class UnitNameToUnitTransformer implements DataTransformerInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Transforms an object (user) to a string (number).
     *
     * @param  Units|null $unit
     * @return string
     */
    public function transform($unit)
    {
        if (null === $unit) {
            return '';
        }

        return $unit->getName();
    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param  string $unitName
     * @return Units|null
     * @throws TransformationFailedException if object (user) is not found.
     */
    public function reverseTransform($unitName)
    {
        if ($unitName == "None"){
            return null;
        }

        $unit = $this->entityManager->getRepository(Units::class)->findOneBy(['name' => $unitName]);


        if (null === $unit) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'An user with unitname "%s" does not exist!',
                $unitName
            ));
        }

        return $unit;
    }
}