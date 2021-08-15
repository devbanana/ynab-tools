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

namespace Devbanana\YnabTools\Tests\Acceptance;

use Devbanana\YnabTools\Domain\Model\User\UserId;
use Devbanana\YnabTools\Domain\Model\User\UserRepositoryInterface;

final class UserRepositoryStub implements UserRepositoryInterface
{
    private string $uuid;

    public function useUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    public function createIdentity(): UserId
    {
        return UserId::fromString($this->uuid);
    }
}