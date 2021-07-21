<?php


namespace app\controllers;


use app\model\Product;

class ProductController extends Controller
{
    public function actionCatalog(){

        echo $this->render('catalog',[
            'catalog' => Product::getAll()
        ]);
    }

    public function actionCard(){
        $id = (int)$_GET['id'];
        var_dump($id);
        echo $this->render('card',[
            'product' => Product::getOne($id)
        ]);
    }

    public function actionIndex(){
        echo "index";
    }
}