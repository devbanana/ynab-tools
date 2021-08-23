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

use Devbanana\YnabTools\Domain\Model\User\UserId;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class UserIdTest extends TestCase
{
    public function testItCannotBeEmpty(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        UserId::fromString('');
    }

    public function testItRequiresAValidUuid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        UserId::fromString('foo');
    }

    public function testItConvertsUuidToBase32(): void
    {
        self::assertEqualsCanonicalizing(
            UserId::fromString('01FDRHBQY0PSFJX3YVM8S6TMP4'),
            UserId::fromString('017b7115-dfc0-b65f-2e8f-dba2326d52c4')
        );
    }
}
