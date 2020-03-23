<?php

namespace SG\Modules\Backend\Controllers;

use SG\Models\Promotion;
use SG\Modules\Backend\Forms\PromotionForm;
use SG\Modules\GlobalController;

class PromotionsController extends ControllerBase
{

    public function indexAction()
    {
        $promotions = Promotion::find();
        $this->view->promotions = $promotions;
        $this->helper->menu('promotions');
        $this->helper->breadcrumbs(['dashboard' => 'cms/dashboard', 'promotions' => 'cms/promotions']);
    }

    public function addAction($promotion = null)
    {
        $promotion = $promotion ?? new Promotion();
        $form = new PromotionForm($promotion);

        if ($this->request->isPost()) {
            $data = $this->request->getPost();
            if ($form->isValid($data)) {

                $valid_from = new \DateTime($data['valid_from']);
                $valid_to = new \DateTime($data['valid_to']);
                if ($valid_from > $valid_to) {
                    $data['valid_from'] = $valid_to->format('d-m-Y');
                    $data['valid_to'] = $valid_from->format('d-m-Y');
                }

                $data['is_active'] = isset($data['is_active']) ? $data['is_active'] : 0;
                $form->bind($data, $promotion);

                if ($promotion->save()) {
                    $message = isset($promotion->id) ? $this->locale->t('success_update_promotion') : $this->locale->t("success_add_promotion");
                    $this->flash->success($message);
                    $this->response->redirect("/cms/promotions");
                }
            }
        }

        $this->view->form = $form;
        $this->helper->menu("promotions");

        if (isset($promotion->id)) {
            $this->helper->breadcrumbs(['dashboard' => '/cms/dashboard', 'promotions' => 'cms/promotions', 'edit_promotion' => 'cms/promotions/edit']);
        } else {
            $this->helper->breadcrumbs(['dashboard' => 'cms/dashboard', 'promotions' => 'cms/promotions', 'add_promotion' => 'cms/promotions/add']);
        }
    }

    public function editAction($id)
    {
        $promotion = Promotion::findFirst($id);
        if (!$promotion) $this->response->redirect("/cms/promotions/add");

        $this->addAction($promotion);
        $this->view->promotion = $promotion;
    }

    public function deleteAction($id)
    {
        if ($this->helper->getAccessLevel("promotions") > $this->account->level) {
            $this->flash->error($this->locale->t('no_access_to_this_page'));
        } else {
            $product = Promotion::findFirst($id);
            if ($product && $product->delete()) {
                $this->flash->success($this->locale->t('success_delete_promotion'));
            }
        }
        $this->response->redirect($_SERVER['HTTP_REFERER']);
    }
}