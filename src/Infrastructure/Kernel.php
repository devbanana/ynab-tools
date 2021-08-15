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

namespace Devbanana\YnabTools\Infrastructure;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

final class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import('../../config/{packages}/*.yaml');
        $container->import('../../config/{packages}/' . $this->environment . '/*.yaml');

        if (is_file($this->getConfigDir() . '/services.yaml')) {
            $container->import($this->getConfigDir() . '/services.yaml');
            $container->import($this->getConfigDir() . '/{services}_' . $this->environment . '.yaml');
        } else {
            $container->import('../../config/{services}.php');
        }
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import($this->getConfigDir() . '/{routes}/' . $this->environment . '/*.yaml');
        $routes->import($this->getConfigDir() . '/{routes}/*.yaml');

        if (is_file($this->getConfigDir() . '/routes.yaml')) {
            $routes->import($this->getConfigDir() . '/routes.yaml');
        } else {
            $routes->import($this->getConfigDir() . '/{routes}.php');
        }
    }

    /**
     * Get the configuration directory.
     */
    private function getConfigDir(): string
    {
        return $this->getProjectDir() . '/config';
    }
}
