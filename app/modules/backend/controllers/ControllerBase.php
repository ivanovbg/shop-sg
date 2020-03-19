<?php
declare(strict_types=1);

namespace SG\Modules\Backend\Controllers;

use SG\Helpers\Cache;
use SG\Models\Admin;
use SG\Modules\GlobalController;

class ControllerBase extends GlobalController{
    private $routes_without_profile = ['profile-login', 'profile-reset-password', 'profile-forgot-password'];
    public $account;
    private $prefix;

    function onConstruct(){
        parent::onConstruct();
        $this->prefix = "_".$this->router->getModuleName().'_';
        $this->account = $this->account();
        $this->__init();
        $this->helper->loadMenu();
    }

    private function account(){
        $key = $this->prefix."account_id";

        $account_id = $this->session->get($key);
        $account_id_c = $this->cookies->get($key)->getValue();

        if(!$account_id && !$account_id_c || ($account_id && $account_id_c && ($account_id != $account_id_c))) return false;

        $id = $account_id ?? $account_id_c;
        $account = Admin::findFirst(['conditions' => 'id = :id:', 'bind' => ['id' => $id], 'cache' => ['key'=> Cache::key("account_id", [$id]), 'lifetime' => Cache::lifetime("account_id")]]);

        if(!$account_id && $account){
            $this->session->set($key, $account_id_c);
        }

        if(!$account){
            $this->cookies->delete($key);
            $this->session->remove($key);
            return false;
        }

        $this->view->account = $account;
        return $account;
    }

    function __init(){
        if($this->router->getControllerName() == "xhr") return false;
        $key = $this->router->getControllerName().'-'.$this->router->getActionName();
        if($this->account && in_array($key, $this->routes_without_profile)){
            return $this->response->redirect("cms")->send();
        }elseif(!$this->account && !in_array($key, $this->routes_without_profile)){
           return $this->response->redirect("cms/profile/login")->send();
        }
    }


}
