<?php

declare(strict_types=1);

/**
 * This file is part of YNAB Tools.
 *
 * YNAB Tools is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * YNAB Tools is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with YNAB Tools.  If not, see <https://www.gnu.org/licenses/>.
 *
 * @author Brandon Olivares <programmer2188@gmail.com>
 * @copyright (C) 2021 Brandon Olivares <programmer2188@gmail.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace App\Tests\Behat;

use App\Entity\User;
use App\Repository\UserRepository;
use Behat\MinkExtension\Context\MinkContext;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class SecurityContext extends MinkContext
{
    public function __construct(
        private UserRepository $userRepository,
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $hasher
    ) {
    }

    /**
     * @Given I am a registered user with the email :email and the password :password
     */
    public function iAmARegisteredUser(string $email, string $password): void
    {
        $user = new User();
        $user->setEmail($email);
        $user->setPassword(
            $this->hasher->hashPassword($user, $password)
        );
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    /**
     * @BeforeScenario
     */
    public function startTransaction(): void
    {
        $schema = new SchemaTool($this->entityManager);
        $classes = $this->entityManager->getMetadataFactory()->getAllMetadata();
        $schema->dropSchema($classes);
        $schema->createSchema($classes);
    }
}
