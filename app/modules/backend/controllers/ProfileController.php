<?php
namespace SG\Modules\Backend\Controllers;

use http\Header;

class ProfileController extends ControllerBase {

    function indexAction(){
        $this->helper->breadcrumbs(['dashboard' => 'cms/dashboard', 'profile' => 'cms/profile']);
    }

    function loginAction(){

    }

    function forgotPasswordAction(){

    }

    function logoutAction(){
        $this->view->disable();
        $this->session->remove("_cms_account_id");
        $this->cookies->get('_cms_account_id')->delete();
        return $this->response->redirect("cms/profile/login")->sendCookies()->send();
    }

}