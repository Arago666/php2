<?php


namespace app\controllers;

use app\model\Basket;

class BasketController extends Controller
{
    public function actionIndex(){
        //TODO доделать с сессией
//        $products = Basket::getBasket(session_id());
        $products = Basket::getBasket(1);
        var_dump($products);
        echo $this->render('basket', ['products' => $products]);
    }
}