<?php


namespace app\controllers;

use app\engine\Request;

use app\model\entities\Basket;
use app\model\repositories\BasketRepository;

class BasketController extends Controller
{
    public function actionIndex(){
        $products = (new BasketRepository())->getBasket(session_id());
        echo $this->render('basket', ['products' => $products]);
    }

    public function actionBuy(){
        //добавляем в корзину элемент текущей сессии
//        $data = json_decode(file_get_contents('php://input'));
//        $id = $data->id;

        $id = (int)(new Request())->getParams()['id'];
        $basket = new Basket(session_id(),$id);

        (new BasketRepository())->save($basket);

        //возвращаем количество элементов в корзине
        echo json_encode([
            'status' => 'ok',
            'count' => (new BasketRepository())->getCountWhere('session_id', session_id()),
        ]);
        die();
    }

    public function actionDelete(){
        $id = (int)(new Request())->getParams()['id'];

        $basket = (new BasketRepository())->getOne($id);
        $session = session_id();
        if($session == $basket->session_id){
            (new BasketRepository())->delete($basket);
        }
        else{
            die;
        }
        //Basket::getOne($id)->delete();

        //возвращаем количество элементов в корзине
        echo json_encode([
            'status' => 'ok',
            'count' => (new BasketRepository())->getCountWhere('session_id', session_id()),
        ]);
//        header("Location: " . $_SERVER['HTTP_REFERER']);
        die();
    }
}