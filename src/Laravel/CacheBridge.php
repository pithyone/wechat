<?php

namespace WeWork\Laravel;

use Illuminate\Support\Facades\Cache;
use Psr\SimpleCache\CacheInterface;

class CacheBridge implements CacheInterface
{
    public function get($key, $default = null)
    {
        return Cache::get($key, $default);
    }

    public function set($key, $value, $ttl = null)
    {
        Cache::put($key, $value, $this->toMinutes($ttl));
    }

    public function delete($key)
    {
        //
    }

    public function clear()
    {
        //
    }

    public function getMultiple($keys, $default = null)
    {
        //
    }

    public function setMultiple($values, $ttl = null)
    {
        //
    }

    public function deleteMultiple($keys)
    {
        //
    }

    public function has($key)
    {
        return Cache::has($key);
    }

    protected function toMinutes($ttl = null)
    {
        if (!is_null($ttl)) {
            return $ttl / 60;
        }
    }
}
