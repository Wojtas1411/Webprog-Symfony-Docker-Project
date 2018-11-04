<?php
/**
 * Created by PhpStorm.
 * User: wojtek
 * Date: 04.11.18
 * Time: 16:28
 */

namespace App\Form\DataTransformers;

use App\Entity\User;
use App\Entity\PersonalData;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;


class UserNameToPersonalDataTransformer implements DataTransformerInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Transforms an object (user) to a string (number).
     *
     * @param  PersonalData|null $user
     * @return string
     */
    public function transform($user)
    {
        if (null === $user) {
            return '';
        }

        $temp = $this->entityManager->getRepository(User::class)->find($user->getUserID());

        return $temp->getUsername();
    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param  string $userName
     * @return PersonalData|null
     * @throws TransformationFailedException if object (user) is not found.
     */
    public function reverseTransform($userName)
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['username' => $userName]);

        $data = $this->entityManager->getRepository(PersonalData::class)->findOneBy(['UserID' => $user->getId()]);

        if (null === $data) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'An user with username "%s" does not exist!',
                $userName
            ));
        }

        return $data;
    }

}