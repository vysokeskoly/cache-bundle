<?php declare(strict_types=1);

namespace VysokeSkoly\CacheBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use VysokeSkoly\CacheBundle\Cache\MemcachedFactory;

class VysokeSkolyCacheExtension extends Extension
{
    public function load(array $config, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $config);

        foreach ($config['connections'] as $name => $connection) {
            $this->addMemcachedServices($container, $name, $connection);
        }
    }

    private function addMemcachedServices(ContainerBuilder $container, string $name, array $connection): void
    {
        $classDefinition = \Memcached::class;
        $factoryClass = MemcachedFactory::class;

        $service = new Definition($classDefinition);
        $service->setFactory([$factoryClass, 'get']);
        $service->addArgument($connection);
        $service->setPublic(false);

        $container->setDefinition('vysokeskoly.cache.' . $name, $service);
    }
}
