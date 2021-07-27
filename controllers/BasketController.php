<?php


namespace app\controllers;

use app\model\Basket;

class BasketController extends Controller
{
    public function actionIndex(){
        $products = Basket::getBasket(session_id());
        var_dump($products);
        echo $this->render('basket', ['products' => $products]);
    }
}