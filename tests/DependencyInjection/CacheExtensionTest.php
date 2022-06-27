<?php declare(strict_types=1);

namespace VysokeSkoly\CacheBundle\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use VysokeSkoly\CacheBundle\Cache\MemcachedFactory;

class CacheExtensionTest extends TestCase
{
    protected ContainerBuilder $containerBuilder;
    protected CacheExtension $extension;
    protected array $config;

    protected function setUp(): void
    {
        $this->config = [
            'connections' => [
                'session' => [
                    'persistent_id' => 'session_per_id',
                    'servers' => [
                        'first' => [
                            'host' => 'memc',
                            'port' => 11211,
                        ],
                    ],
                ],
                'data' => [
                    'persistent_id' => 'data_per_id',
                    'servers' => [
                        'first' => [
                            'host' => 'memc',
                            'port' => 11311,
                        ],
                    ],
                ],
            ],
        ];

        $this->extension = new CacheExtension();
        $this->containerBuilder = new ContainerBuilder();
        $this->containerBuilder->registerExtension($this->extension);
        $this->extension->load([$this->config], $this->containerBuilder);
    }

    public function testShouldRegisterServices(): void
    {
        $registeredServices = ['session', 'data'];

        foreach ($registeredServices as $service) {
            $serviceName = 'vysokeskoly.cache.' . $service;
            $this->assertTrue($this->containerBuilder->has($serviceName));

            $definition = $this->containerBuilder->getDefinition($serviceName);
            $this->assertFalse($definition->isPublic());
            $factoryClass = MemcachedFactory::class;

            $this->assertSame([$factoryClass, 'get'], $definition->getFactory());
        }
    }
}
