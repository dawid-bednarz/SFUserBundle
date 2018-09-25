<?php
/**
 *  * Created by PhpStorm.
 * User: Dawid Bednarz( dawid@bednarz.pro )
 */
declare(strict_types=1);

namespace DawBed\UserBundle\DependencyInjection;

use DawBed\UserBundle\Entity\User\UserInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration implements \Symfony\Component\Config\Definition\ConfigurationInterface
{

    public function getConfigTreeBuilder()
    {

        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('dawbed_user_bundle');

        $rootNode
            ->children()
            ->arrayNode('entities')
            ->children()
            ->scalarNode('user')
            ->validate()
            ->ifTrue(function ($value) {
                return !is_subclass_of($value, UserInterface::class);
            })->thenInvalid('Must be instanceof ' . UserInterface::class)
            ->end()
            ->end()
            ->end()
            ->end();

        return $treeBuilder;
    }
}