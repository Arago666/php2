<?php


namespace app\controllers;


use app\engine\Request;
use app\model\Product;

class ProductController extends Controller
{
    public function actionCatalog(){
//        $page = (int)$_GET['page'];
        $page = (int)(new Request())->getParams()['page'];
        echo $this->render('catalog',[
            'catalog' => Product::getLimit(($page + 1) * 2),
            'page' => ++$page
        ]);
    }

    public function actionCard(){
//        $id = (int)$_GET['id'];
        $id = (int)(new Request())->getParams()['id'];
        var_dump(Product::getOne($id));
        echo $this->render('card',[
            'product' => Product::getOne($id)
        ]);
    }

    public function actionIndex(){
        echo $this->render('index');
    }
}