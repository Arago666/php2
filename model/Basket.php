<?php


namespace app\model;


use app\engine\Db;

class Basket extends DbModel
{
    public static function getBasket($session) {
        $sql = "SELECT p.id id_prod, b.id id_basket, p.name, p.description, p.price FROM basket b, products p WHERE b.product_id=p.id AND session_is = :session";
        //TODO
        return Db::getInstance()->queryAll($sql, ['session' => $session]);
    }

    static public function getTableName()
    {
        return "basket";
    }
}