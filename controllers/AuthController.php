<?php


namespace app\controllers;


use app\model\User;

class AuthController extends Controller
{
    public function actionLogin(){
        //TODO Переделать на Request
        $login = $_POST['login'];
        $pass = $_POST['pass'];
        if(User::auth($login, $pass)){
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else{
            die("Неверный логин или пароль");
        }
    }

    public function actionLogout(){
        session_destroy();
        //TODO завернуть в Request
        header("Location:" . $_SERVER['HTTP_REFERER']);
    }


}