<?php

namespace XTAIN\Psr\Cache;

use Psr\Cache\CacheItemPoolInterface;

interface CacheItemPoolAwareInterface
{
    /**
     * @param CacheItemPoolInterface $cache
     */
    public function setCachePool(CacheItemPoolInterface $cache);
}
