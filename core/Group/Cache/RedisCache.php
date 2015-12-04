<?php

namespace core\Group\Cache;

use Exception;
use core\Group\Contracts\Cache\Cache as CacheContract;

class RedisCache implements CacheContract
{
    /**
     * redis对象
     *
     * @var  object
     */
    protected $redis;

    public function __construct($app)
    {
        $this -> redis = $app -> singleton('redis');
    }

    /**
     * 获取cache
     *
     * @param  cacheName
     * @return string|array|false
     */
    public function get($cacheName)
    {
        return $this -> redis -> get($cacheName);
    }

    /**
     * 设置cache
     *
     * @param  cacheName(string)
     * @param  data(array)
     * @param  expireTime(int)
     * @return boolean
     */
    public function set($cacheName, $data, $expireTime = 3600)
    {
        return $this -> redis -> set($cacheName, $data, $expireTime);
    }

    /**
     * 获取hash cache
     *
     * @param  hashKey
     * @param  key
     * @return string|array|false
     */
    public function hGet($hashKey, $key)
    {
        return $this-> redis -> hGet($hashKey, $key);
    }

    /**
     * 设置hash cache
     *
     * @param  hashKey
     * @param  key
     * @param  data
     * @param  expireTime(int)
     * @return boolean
     */
    public function hSet($hashKey, $key, $data, $expireTime = 3600)
    {
        $status = $this -> redis -> hSet($hashKey, $key, $data);

        $this -> redis -> expire($hashKey, $expireTime);

        return $status;
    }

    /**
     * 删除hash
     *
     * @param  hashKey
     * @param  key
     * @return boolean
     */
    public function hDel($hashKey, $key = null)
    {
        if($key) return $this-> redis -> hDel($hashKey, $key);

        return $this-> redis -> hDel($hashKey);
    }
}