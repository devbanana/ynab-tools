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

namespace Devbanana\YnabTools\Domain\Model\User;

use Devbanana\YnabTools\Domain\Contract\Service\PasswordHasher;
use Devbanana\YnabTools\Domain\Model\User\Exception\CouldNotHashPassword;
use Webmozart\Assert\Assert;

final class Password
{
    /**
     * @param non-empty-string $password
     */
    private function __construct(private string $password)
    {
    }

    /**
     * @param non-empty-string $password
     *
     * @throws CouldNotHashPassword
     */
    public static function fromPlainPassword(string $password, PasswordHasher $hasher): self
    {
        Assert::minLength($password, 8, 'Password must be at least %2$d characters long');

        $hashedPassword = $hasher->hash($password);
        if ($hashedPassword === '') {
            throw CouldNotHashPassword::becauseTheHashWasEmpty();
        }

        return new self($hashedPassword);
    }

    public function asHash(): string
    {
        return $this->password;
    }
}
