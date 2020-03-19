<?php
namespace SG\Helpers;

use Phalcon\Di\Injectable;
use Phalcon\Translate\Adapter\NativeArray;
use Phalcon\Translate\InterpolatorFactory;
use Phalcon\Translate\TranslateFactory;

class Locale extends Injectable{

    private static $istance;

    private function __construct(){

    }

    static function getInstance(){
        if(!self::$istance){
            self::$istance = new Locale();
        }

        return self::$istance;
    }

    function getTranslator(): NativeArray{
        $languages_config = $this->getDI()->get('config')->languages;
        $user_language = $this->cookies->has("_locale") ? $this->cookies->get("_locale")->getValue() : false;
        $load_language = $user_language && in_array($user_language, $languages_config->get('list')->toArray()) ? $user_language : $languages_config->get('default');
        $load_language = APP_PATH . "/translations/{$load_language}.php";

        if(!file_exists($load_language)){
            throw new \Exception("Unable to load language file");
            exit;
        }
        include $load_language;

        $option = [
            'content'     => $msg
        ];

        $interpolator = new InterpolatorFactory();
        $factory      = new TranslateFactory($interpolator);

        $translation = $factory->newInstance('array', $option);


        return $translation;
    }

}