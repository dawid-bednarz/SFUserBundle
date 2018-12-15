<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pro )
 */
declare(strict_types=1);

namespace DawBed\UserRegistrationBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class UserRegistrationExtension extends Extension implements PrependExtensionInterface
{
    const ALIAS = 'dawbed_user_registration_bundle';

    public function prepend(ContainerBuilder $container): void
    {
        $loader = $this->prepareLoader($container);
        $loader->load('packages/status_bundle.yaml');
    }

    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = $this->prepareLoader($container);
        $loader->load('services.yaml');
    }

    public function getAlias(): string
    {
        return self::ALIAS;
    }

    private function prepareLoader(ContainerBuilder $containerBuilder): YamlFileLoader
    {
        return new YamlFileLoader($containerBuilder, new FileLocator(dirname(__DIR__) . '/Resources/config'));
    }

}