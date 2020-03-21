<?php
namespace SG\Helpers;

use Phalcon\Di;

class Helper{
    private static $instance = false;
    private $menuItems = [];

    private function __construct(){

    }

    public static  function getInstance(){
        if(self::$instance) {
            return self::$instance;
        }
        return new Helper();
    }



    public function breadcrumbs($links){
        $translator = Di::getDefault()->get("locale");
        $view = Di::getDefault()->get("view");

        $breadcrumbs = [];
        if(!empty($links)){
            foreach($links as $lang_key => $link){
                $breadcrumbs[] = ['title' => $translator->t($lang_key), 'href' => $link];
            }
        }

        $view->breadcrumbs = $breadcrumbs;
    }

    public function menu($main = false, $sub = false){
        $view = Di::getDefault()->get("view");
        $view->main_link_active = $main;
        $view->sub_link_active  = $sub;
    }


    public function loadMenu($return = false){
        $menu_file = APP_PATH . '/config/menu.php';
        if (!file_exists($menu_file)) return false;
        include $menu_file;

        if($return) return $menu;

        $view = Di::getDefault()->get("view");
        $view->menu = $menu;
    }

    public function getAccessLevel($key){
        $menuItems = self::loadMenu(true);
        if(array_key_exists($key, $menuItems)) return $menuItems[$key]['access_level'];
        return 0;
    }

    public function languageSwitch(){
        $languages = Di::getDefault()->getConfig()->languages->list->toArray();
        $cookies = Di::getDefault()->get('cookies');
        $current_language = Di::getDefault()->get('cookies')->has('_locale') ? Di::getDefault()->get('cookies')->get('_locale')->getValue() : Di::getDefault()->getConfig()->languages->default;
        $languages = array_diff($languages, [$current_language]);

        $view = Di::getDefault()->get("view");
        $view->languages = $languages;
    }
}