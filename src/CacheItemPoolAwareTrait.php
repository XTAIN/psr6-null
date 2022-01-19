<?php

namespace XTAIN\Psr\Cache;

use Psr\Cache\CacheItemPoolInterface;

trait CacheItemPoolAwareTrait
{
    /**
     * @var CacheItemPoolInterface
     */
    protected $cache;

    /**
     * @param CacheItemPoolInterface $cache
     */
    public function setCachePool(CacheItemPoolInterface $cache)
    {
        $this->cache = $cache;
    }
}
