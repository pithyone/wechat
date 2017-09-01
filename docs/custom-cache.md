## 自定义缓存

如果你需要集成其他框架的缓存操作，可以自己建立一个类并继承 [`Doctrine\Common\Cache\CacheProvider`](https://github.com/doctrine/cache/blob/master/lib/Doctrine/Common/Cache/CacheProvider.php) 来完成缓存操作

### 示例

```php
<?php

use Doctrine\Common\Cache\CacheProvider;

class MyCache extends CacheProvider
{
    /**
     * Fetches an entry from the cache.
     *
     * @param string $id The id of the cache entry to fetch.
     *
     * @return mixed|false The cached data or FALSE, if no cache entry exists for the given id.
     */
    protected function doFetch($id)
    {
        // TODO: Implement doFetch() method.
    }

    /**
     * Tests if an entry exists in the cache.
     *
     * @param string $id The cache id of the entry to check for.
     *
     * @return bool TRUE if a cache entry exists for the given cache id, FALSE otherwise.
     */
    protected function doContains($id)
    {
        // TODO: Implement doContains() method.
    }

    /**
     * Puts data into the cache.
     *
     * @param string $id         The cache id.
     * @param string $data       The cache entry/data.
     * @param int    $lifeTime   The lifetime. If != 0, sets a specific lifetime for this
     *                           cache entry (0 => infinite lifeTime).
     *
     * @return bool TRUE if the entry was successfully stored in the cache, FALSE otherwise.
     */
    protected function doSave($id, $data, $lifeTime = 0)
    {
        // TODO: Implement doSave() method.
    }

    /**
     * Deletes a cache entry.
     *
     * @param string $id The cache id.
     *
     * @return bool TRUE if the cache entry was successfully deleted, FALSE otherwise.
     */
    protected function doDelete($id)
    {
        // TODO: Implement doDelete() method.
    }

    /**
     * Flushes all cache entries.
     *
     * @return bool TRUE if the cache entries were successfully flushed, FALSE otherwise.
     */
    protected function doFlush()
    {
        // TODO: Implement doFlush() method.
    }

    /**
     * Retrieves cached information from the data store.
     *
     * @since 2.2
     *
     * @return array|null An associative array with server's statistics if available, NULL otherwise.
     */
    protected function doGetStats()
    {
        // TODO: Implement doGetStats() method.
    }
}
```

### 用法

```php
$myCache = new MyCache();

$config = [
    //...

    'cache' => $myCacheDriver,
];

$work = new Work($config);
```
