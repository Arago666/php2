<?php


namespace app\engine;


class Router
{
    private $router = [
        '/' => 'BasketController@index',
        '/catalog' => 'ProductController@catalog',
        '/catalog/card/{id}/edit/{name}' => 'ProductController@card'
    ];

    public function route(){

    }

}