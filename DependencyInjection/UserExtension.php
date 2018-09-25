<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pro )
 */
declare(strict_types=1);

namespace DawBed\UserBundle\DependencyInjection;

use DawBed\UserBundle\Event\Events;
use DawBed\UserBundle\Exception\InstallationException;
use DawBed\UserBundle\Service\User\CreateService;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class UserExtension extends Extension implements PrependExtensionInterface
{
    public function prepend(ContainerBuilder $container): void
    {
        $this->checkHasRegisteredListeners($container);
    }

    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $loader = new YamlFileLoader($container, new FileLocator(dirname(__DIR__) . '/Resources/config'));
        $loader->load('services.yaml');
        $config = $this->processConfiguration($configuration, $configs);
    }

    public function getAlias(): string
    {
        return 'dawbed_user_bundle';
    }

    private function checkHasRegisteredListeners(ContainerBuilder $container): void
    {
        $events = (new Events)->getRequired()
            ->getInnerIterator();
        $notFoundListener = false;
        while ($events->valid() && !$notFoundListener) {
            $notFoundListener = true;
            foreach ($container->findTaggedServiceIds('kernel.event_listener') as $arrayEventsTag) {
                if (in_array($events->key(), array_column($arrayEventsTag, 'event'))) {
                    $notFoundListener = false;
                    break 2;
                } else {
                    $notFoundListener = true;
                }
            }
            $events->next();
        }
        if ($notFoundListener) {
            throw new InstallationException(sprintf('"%s" Some event listener is required for propertly working this bundle. Read more about it in documentation %s', $events->current(), 'https://github.com/dawid-bednarz/SFUserBundle/blob/master/README.md'));
        }
    }
}