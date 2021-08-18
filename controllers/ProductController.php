<?php


namespace app\controllers;


use app\engine\App;
use app\engine\Request;
use app\model\repositories\ProductRepository;

class ProductController extends Controller
{
    public function actionCatalog(){
//        $page = (int)$_GET['page'];
        $page = (int)App::call()->request->getParams()['page'];
        echo $this->render('catalog',[
            'catalog' => App::call()->productRepository->getLimit(($page + 1) * 2),
            'page' => ++$page
        ]);
    }

    public function actionCard(){
//        $id = (int)$_GET['id'];
        $id = (int)App::call()->request->getParams()['id'];
        //var_dump(Product::getOne($id));
        echo $this->render('card',[
            'product' => App::call()->productRepository->getOne($id)
        ]);
    }

    public function actionIndex(){
        echo $this->render('index');
    }
}