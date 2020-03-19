<?php
namespace SG\Helpers;

use Phalcon\Di;

class Volt{

    public static function assets($asset, $module = false){
        $di = Di::getDefault();
        $module = !$module ? $di->get('router')->getModuleName() : $module;
        return $di->get('settings')->get('domain').'/'.$di->get('settings')->get('assets')->get($module).'/'.$asset;
    }

    public static function last($array){
        if(empty($array)) return false;
        return end($array);
    }

    public static function price($price){
        return number_format((float)$price, 2, '.', '').'лв.';
    }



    /**
     * @param \Phalcon\Mvc\View\Engine\Volt $volt
     * @return \Phalcon\Mvc\View\Engine\Volt
     * @description: add custom volt filters
     */
    public static function filters($volt){
        $volt->getCompiler()->addFilter("last", function($array){
            return '\SG\Helpers\Volt::last('.$array.')';
        });

        $volt->getCompiler()->addFilter("price", function($price){
           return  '\SG\Helpers\Volt::price('.$price.')';
        });
        return $volt;
    }

    /**
     * @param \Phalcon\Mvc\View\Engine\Volt $volt
     * @return \Phalcon\Mvc\View\Engine\Volt
     * @description: add custom volt functions
     */
    public static function functions($volt){
        $volt->getCompiler()->addFunction("asset", function($asset){
            return '\SG\Helpers\Volt::assets('.$asset.')';
        });
        return $volt;
    }

}