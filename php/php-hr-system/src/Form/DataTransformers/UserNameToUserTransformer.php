<?php
/**
 * Created by PhpStorm.
 * User: wojtek
 * Date: 04.11.18
 * Time: 15:57
 */

namespace App\Form\DataTransformers;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class UserNameToUserTransformer implements DataTransformerInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Transforms an object (user) to a string (number).
     *
     * @param  User|null $user
     * @return string
     */
    public function transform($user)
    {
        if (null === $user) {
            return '';
        }

        return $user->getUsername();
    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param  string $userName
     * @return User|null
     * @throws TransformationFailedException if object (user) is not found.
     */
    public function reverseTransform($userName)
    {
        //$user = $this->entityManager->getRepository(User::class)->find($userName);
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['username' => $userName]);
        //$user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['PrimaryName' => $userName]);

        if (null === $user) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'An user with username "%s" does not exist!',
                $userName
            ));
        }

        return $user;
    }

}