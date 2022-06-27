<?php declare(strict_types=1);

namespace VysokeSkoly\CacheBundle\Cache;

class MemcacheFactory
{
    public static function get(array $connection): \Memcache
    {
        $cache = new \Memcache();

        foreach ($connection['servers'] as $server) {
            $cache->addServer($server['host'], $server['port']);
        }

        return $cache;
    }
}
