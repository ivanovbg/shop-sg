<?php
namespace SG\Modules\Backend\Controllers;

use SG\Models\Admin;

class XhrController extends ControllerBase {

    private $responseData;

    function onConstruct(){
        parent::onConstruct();
        $this->responseData = new \stdClass();

        #if(!$this->isAjax) echo "Only ajax"; exit;
    }

    function loginAction(){
        $this->responseData->status = false;
        $this->responseData->msg = $this->locale->t('invalid_cms_login');

        $email          = $this->request->get("email");
        $password       = md5($this->request->get("password"));
        $remember_me    = $this->request->has("remember_me") ? true : false;

        $account = Admin::findFirst([
                                'conditions' => 'email = :email: AND password = :password:',
                                'bind' => ['email' => $email, 'password' => $password]
                                ]);

        if($account){
            $this->session->set('_cms_account_id', $account->id);
            $this->responseData->status = true;

            if($remember_me){
                $this->cookies->set("_cms_account_id", $account->id, time() + 7200, '/');
            }
        }


        $this->response->setJsonContent($this->responseData);
        return $this->response;
    }

    function forgotPasswordAction(){
        $this->responseData->status = true;
        $this->responseData->msg = "test";
        return $this->response->setJsonContent($this->responseData);
    }


}