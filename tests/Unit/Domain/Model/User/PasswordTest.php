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

namespace Devbanana\YnabTools\Tests\Unit\Domain\Model\User;

use Devbanana\YnabTools\Domain\Contract\Service\PasswordHasher;
use Devbanana\YnabTools\Domain\Model\User\Password;
use PHPUnit\Framework\TestCase;

final class PasswordTest extends TestCase
{
    private PasswordHasher $hasher;

    protected function setUp(): void
    {
        $this->hasher = new class() implements PasswordHasher {
            public function hash(string $plainPassword): string
            {
                return password_hash($plainPassword, \PASSWORD_DEFAULT);
            }

            public function verify(string $hash, string $plainPassword): bool
            {
                return password_verify($plainPassword, $hash);
            }
        };
    }

    public function testItMustBeAtLeast8Characters(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Password must be at least 8 characters long');

        Password::fromPlainPassword('foo', $this->hasher);
    }

    public function testItReturnsTheHashedPassword(): void
    {
        $password = Password::fromPlainPassword('foo123bar', $this->hasher);

        self::assertNotSame('foo123bar', $password->asHash());
        self::assertTrue(
            password_verify('foo123bar', $password->asHash())
        );
    }
}
