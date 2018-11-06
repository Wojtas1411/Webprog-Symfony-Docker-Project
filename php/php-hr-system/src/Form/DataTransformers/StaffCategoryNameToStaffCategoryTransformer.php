<?php
/**
 * Created by PhpStorm.
 * User: wojtek
 * Date: 06.11.18
 * Time: 08:54
 */

namespace App\Form\DataTransformers;

use App\Entity\StaffCategory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;


class StaffCategoryNameToStaffCategoryTransformer implements DataTransformerInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Transforms an object (user) to a string (number).
     *
     * @param  StaffCategory|null $category
     * @return string
     */
    public function transform($category)
    {
        if (null === $category) {
            return '';
        }

        return $category->getName();
    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param  string $userName
     * @return StaffCategory|null
     * @throws TransformationFailedException if object (user) is not found.
     */
    public function reverseTransform($staffName)
    {
        $category = $this->entityManager->getRepository(StaffCategory::class)->findOneBy(['Name' => $staffName]);


        if (null === $category) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'An user with username "%s" does not exist!',
                $staffName
            ));
        }

        return $category;
    }
}