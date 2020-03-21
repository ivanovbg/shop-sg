<?php
namespace SG\Modules\Backend\Controllers;

use SG\Models\Product;
use SG\Modules\Backend\Forms\ProductForm;

class ProductsController extends ControllerBase {

    public function indexAction(){
        $products = Product::find();
        $this->view->products = $products;
        $this->helper->menu('products');
        $this->helper->breadcrumbs(['dashboard' => 'cms/dashboard', 'products' => 'cms/products']);
    }

    public function addAction($product = null){
        $product = $product ?? new Product();
        $form = new ProductForm($product);

        if($this->request->isPost()){
            $data = $this->request->getPost();
            if($form->isValid($data)){

                $check_sku = Product::getProductBySku($data['sku'], $product->id);

                if(!$check_sku) {
                    $data['is_active'] = isset($data['is_active']) ? $data['is_active'] : 0;
                    $form->bind($data, $product);
                    if ($product->save()) {
                        $message = $product->id ? $this->locale->t('success_update_product') : $this->locale->t('success_add_product');
                        $this->flash->success($message);
                        $this->response->redirect("/cms/products");
                    }
                }else{
                    $this->flash->error($this->locale->t('product_with_this_sku_exists'));
                }
            }
        }


        $this->view->form = $form;
        $this->helper->menu('products');
        if(!$product){
            $this->helper->breadcrumbs(['dashboard' => 'cms/dashboard', 'products' => 'cms/products', "add_product" => 'cms/products/add']);
        }else{
            $this->helper->breadcrumbs(['dashboard' => 'cms/dashboard', 'products' => 'cms/products', "edit_product" => 'cms/products/edit/'.$product->id]);
        }
    }

    public function editAction($id){
        $product = Product::getProduct($id);
        if(!$product) $this->response->redirect("/cms/products/add");
        $this->addAction($product);
        $this->view->product = $product;
    }

    public function deleteAction($id){
        if($this->helper->getAccessLevel("products") > $this->account->level){
            $this->flash->error($this->locale->t('no_access_to_this_page'));
        }else{
            $product = Product::findFirst($id);
            if($product && $product->delete()){
                $this->flash->success($this->locale->t('success_delete_product'));
            }
        }
        $this->response->redirect($_SERVER['HTTP_REFERER']);
    }
}