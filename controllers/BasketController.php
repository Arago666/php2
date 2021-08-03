<?php


namespace app\controllers;

use app\engine\Request;
use app\model\Basket;

class BasketController extends Controller
{
    public function actionIndex(){
        $products = Basket::getBasket(session_id());
        echo $this->render('basket', ['products' => $products]);
    }

    public function actionBuy(){
        //добавляем в корзину элемент текущей сессии
//        $data = json_decode(file_get_contents('php://input'));
//        $id = $data->id;

        $id = (int)(new Request())->getParams()['id'];

        (new Basket(session_id(),$id))->save();

        //возвращаем количество элементов в корзине
        echo json_encode([
            'status' => 'ok',
            'count' => Basket::getCountWhere('session_id', session_id()),
        ]);
        die();
    }

    public function actionDelete(){
        $id = (int)(new Request())->getParams()['id'];

        $basket = (new Basket())->getOne($id);
        $session = session_id();
        if($session == $basket->session_id){
            $basket->delete();
        }
        else{
            die;
        }
        //Basket::getOne($id)->delete();

        //возвращаем количество элементов в корзине
        echo json_encode([
            'status' => 'ok',
            'count' => Basket::getCountWhere('session_id', session_id()),
        ]);
//        header("Location: " . $_SERVER['HTTP_REFERER']);
        die();
    }
}