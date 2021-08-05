<?php


namespace app\controllers;




use app\model\entities\User;
use app\model\repositories\UserRepository;

class AuthController extends Controller
{
    public function actionLogin(){
        //TODO Переделать на Request
        $login = $_POST['login'];
        $pass = $_POST['pass'];
        if((new UserRepository())->auth($login, $pass)){
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