<?php declare(strict_types=1);

use Symplify\EasyCodingStandard\Config\ECSConfig;

$doctrineCacheBridge = [
    'src/FrontBundle/Adapter/DoctrineCacheBridge.php',
];

return ECSConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    ->withRootFiles()
    ->withSets([
        __DIR__ . '/vendor/lmc/coding-standard/ecs.php',
    ]);
