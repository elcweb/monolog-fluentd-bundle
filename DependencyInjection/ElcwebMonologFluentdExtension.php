<?php

namespace Elcweb\Monolog\FluentdBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ElcwebMonologFluentdExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        // Set the level to the correct integer value provided by Monolog
        $config['level'] = is_int($config['level']) ?
            $config['level'] : constant('Monolog\Logger::'.strtoupper($config['level']));

        $container->setParameter('monolog_fluentd.fluentd.port', $config['port']);
        $container->setParameter('monolog_fluentd.fluentd.host', $config['host']);
        $container->setParameter('monolog_fluentd.fluentd.level', $config['level']);
        $container->setParameter('monolog_fluentd.fluentd.bubble', $config['bubble']);
        $container->setParameter('monolog_fluentd.fluentd.env', $config['env']);
        $container->setParameter('monolog_fluentd.fluentd.tag', $config['tag']);
    }
}
