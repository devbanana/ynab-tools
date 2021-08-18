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

namespace Devbanana\YnabTools\Domain\Service;

use Devbanana\YnabTools\Domain\Contract\Service\PasswordHasher;
use Devbanana\YnabTools\Domain\Model\User\Exception\CouldNotHashPassword;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Webmozart\Assert\Assert;

final class SymfonyPasswordHasher implements PasswordHasher
{
    /**
     * @var string
     */
    private const USER_CLASS = 'default';

    public function __construct(private PasswordHasherFactoryInterface $hasherFactory)
    {
    }

    /**
     * @throws CouldNotHashPassword
     */
    public function hash(string $plainPassword): string
    {
        Assert::maxLength($plainPassword, PasswordHasherInterface::MAX_PASSWORD_LENGTH, 'Password cannot be greater than %d characters long');

        try {
            $hasher = $this->hasherFactory->getPasswordHasher(self::USER_CLASS);

            return $hasher->hash($plainPassword);
        } catch (\RuntimeException) {
            throw CouldNotHashPassword::becauseNoHasherIsConfigured();
        }
    }

    /**
     * @throws CouldNotHashPassword
     */
    public function verify(string $hash, string $plainPassword): bool
    {
        try {
            $hasher = $this->hasherFactory->getPasswordHasher(self::USER_CLASS);

            return $hasher->verify($hash, $plainPassword);
        } catch (\RuntimeException) {
            throw CouldNotHashPassword::becauseNoHasherIsConfigured();
        }
    }
}
