<?php


namespace app\engine;


class Router
{
    private $router = [
        '/' => 'BasketController@index',
        '/catalog' => 'ProductController@catalog',
        '/catalog/card/{id}' => 'ProductController@card'
    ];

    public function route(){

    }

}