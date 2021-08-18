<?php

namespace app\controllers;

use app\engine\App;
use app\model\repositories\UserRepository;

class AuthController extends Controller
{
    public function actionLogin(){

        $login = App::call()->request->getParams()['login'];
        $pass = App::call()->request->getParams()['pass'];
        if(App::call()->userRepository->auth($login, $pass)){
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else{
            die("Неверный логин или пароль");
        }
    }

    public function actionLogout(){
        session_regenerate_id();
        session_destroy();
        //TODO завернуть в Request
        header("Location:" . $_SERVER['HTTP_REFERER']);
    }


}