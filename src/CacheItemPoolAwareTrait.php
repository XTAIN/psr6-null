<?php

namespace XTAIN\Psr\Cache;

use Psr\Cache\CacheItemPoolInterface;

trait CacheItemPoolAwareTrait
{
    protected CacheItemPoolInterface $cache;

    public function setCachePool(CacheItemPoolInterface $cache) : void
    {
        $this->cache = $cache;
    }
}
