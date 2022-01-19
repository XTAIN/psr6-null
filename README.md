
# PSR-6 NullObject cache

The missing PSR-6 NullObject implementation.

You can use this package, when you want to
 - avoid using `null` check logic, read more [here](http://designpatternsphp.readthedocs.org/en/latest/Behavioral/NullObject/README.html)
 - need a fake cache implementation for testing
 
## Install

```
composer require xtain/psr6-null
```

## Example / usage

Before this package, you needed to allow `null` as a parameter, if you wanted to avoid a package dependency to a specific `PSR-6 cache implementation`


### Old code

```php
namespace MyPackage;

use Psr\Cache\CacheItemPoolInterface;

class MyCode
{

    public function setCache(CacheItemPoolInterface $cache = null)
    {
        $this->cache = $cache;
    }

    /**
     * Can return an instance of null, which is bad!
     *
     * @return null CacheItemPoolInterface
     */
    public function getCache()
    {
        return $this->cache;
    }

    private function internalHeavyMethod()
    {
        $cacheKey = 'myKey';
        
        // you need to check first, if there is a cache instance around
        if ($this->getCache() !== null && $this->getCache()->hasItem($cacheKey) === true) {
            // cache is available + it has a cache hit!
            return $this->getCache()->getItem($cacheKey);
        }
        
        $result = do_something_heavy();
        
        // you need to check first, if there is a cache instance around
        if ($this->getCache() !== null) {
            $item = $this->getCache()->getItem($cacheKey);
            $item->set($result);
            $this->getCache()->save($item);
        }
        
        return $result;
    }
}

```

### New code

```php
namespace MyPackage;

use Psr\Cache\CacheItemPoolInterface;
use XTAIN\Psr\Cache\NullCacheItemPool;
use XTAIN\Psr\Cache\CacheItemPoolAwareInterface;
use XTAIN\Psr\Cache\CacheItemPoolAwareTrait;

class MyCode implements CacheItemPoolAwareInterface
{
    use CacheItemPoolAwareTrait;

    /**
     * You could require a cache instance, so you can remove the null check in __construct() as well
     */
    public function __construct()
    {
        $this->cache = new NullCacheItemPool();
    }

    /**
     * @return CacheItemPoolInterface
     */
    public function getCache()
    {
        return $this->cache;
    }

    private function internalHeavyMethod()
    {
        $cacheKey = 'myKey';
        
        if ($this->getCache()->hasItem($cacheKey) === true) {
            // cache is available + it has a cache hit!
            return $this->getCache()->getItem($cacheKey);
        }
        
        $result = do_something_heavy();
        
        $item = $this->getCache()->getItem($cacheKey);
        $item->set($result);
        $this->getCache()->save($item);
        
        return $result;
    }
}
```
