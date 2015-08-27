<?php

namespace Elcweb\Monolog\FluentdBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('elcweb_monolog_fluentd');

        $rootNode
            ->children()
                ->scalarNode('port')->defaultValue(24224)->end()
                ->scalarNode('host')->defaultValue('localhost')->end()
                ->scalarNode('level')->defaultValue(constant('Monolog\Logger::DEBUG'))->end()
                ->booleanNode('bubble')->defaultValue(true)->end()
                ->scalarNode('env')->defaultValue('none')->end()
                ->scalarNode('tag')->defaultValue('backend')->end()
            ->end();

        return $treeBuilder;
    }
}
