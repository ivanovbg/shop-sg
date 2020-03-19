<?php
namespace SG\Models;

use Phalcon\Di;
use Phalcon\Mvc\Model as M;

class Model extends M{

    protected $cache;

    public function onConstruct(){
        #$this->cache = $this->getDI()->get('config')->application->debug ? false : true;
    }

    public static function find($parameters = null) :\Phalcon\Mvc\Model\ResultsetInterface{
        $parameters = self::checkCacheParameters($parameters);
        return parent::find($parameters);
    }

    public static function findFirst($parameters = null){
        $parameters = self::checkCacheParameters($parameters);
        return parent::findFirst($parameters);
    }

    protected static function checkCacheParameters($parameters = null){
        if(isset($parameters['cache']) && Di::getDefault()->get('config')->application->debug){
            unset($parameters['cache']);
        }
        return $parameters;
    }
}