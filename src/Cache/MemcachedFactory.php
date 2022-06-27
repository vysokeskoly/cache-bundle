<?php declare(strict_types=1);

namespace VysokeSkoly\CacheBundle\Cache;

class MemcachedFactory
{
    public static function get(array $connection): \Memcached
    {
        $cache = new \Memcached($connection['persistent_id']);

        if (empty($cache->getServerList())) {
            $cache->setOption(\Memcached::OPT_HASH, \Memcached::HASH_CRC);
            $cache->setOption(\Memcached::OPT_DISTRIBUTION, \Memcached::DISTRIBUTION_MODULA);
            $cache->setOption(\Memcached::OPT_COMPRESSION, false);
            $cache->addServers($connection['servers']);
        }

        return $cache;
    }
}
