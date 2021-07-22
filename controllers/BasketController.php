<?php


namespace app\controllers;


class BasketController extends Controller
{
    public function actionIndex(){
        echo $this->render('index');
    }
}