<?php declare(strict_types=1);

namespace VysokeSkoly\CacheBundle\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Definition\Dumper\YamlReferenceDumper;

class ConfigurationTest extends TestCase
{
    public function testConfigurationDefinition(): void
    {
        $dumper = new YamlReferenceDumper();
        $reference = <<<CONFIG
            vysokeskoly_cache:
                connections:          # Required

                    # Prototype
                    name:
                        persistent_id:        ~ # Required
                        servers:              # Required

                            # Prototype
                            name:
                                host:                 ~ # Required
                                port:                 ~ # Required

            CONFIG;

        $this->assertSame($reference, $dumper->dump(new Configuration()));
    }
}
