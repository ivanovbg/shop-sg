<?php
namespace SG\Helpers;
use Phalcon\Di;

class Cache{
    private static $lifetimes = ['account_id' => 3600];
    public static $default_lifetime = 1800;

    static function lifetime($key){
        $di = Di::getDefault();
        if($di->get("config")->application->debug) return -1;
        return array_key_exists($key, self::$lifetimes) ? self::$lifetimes[$key] : self::$default_lifetime;
    }

    static function key($key, $val = []){
        $di = Di::getDefault();
        $val = empty($val) ? "" : "-".implode('-', $val);
        $module = Di::getDefault()->get('router')->getModuleName();
        return md5($module.$key.$val);
    }

    static function cacheKeyFromQuery($manager){
        $di = DI::getDefault();
        $dialect = $di->get('db')->getDialect();
        return self::key($dialect->select($manager->parse()));
    }

    static function clear($keys){
        $di = Di::getDefault();
        $memcached = new \Memcached();
        $memcached->addServer($di->get('config')->cache->server, $di->get('config')->cache->port);
        $memcached->deleteMulti($keys);
        $memcached->quit();
        return true;
    }
}