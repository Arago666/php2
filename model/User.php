<?php

namespace app\model;

class User extends DbModel
{

    protected $id;
    protected $login;
    protected $pass;

    protected $props = [
        'login' => false,
        'pass' => false,
    ];

    public function __construct($login = null, $pass = null)
    {
        $this->login = $login;
        $this->pass = $pass;
    }

    public static function isAuth(){
        return isset($_SESSION['login']);
    }

    public static function getName(){
        return $_SESSION['login'];
    }

    public static function auth($login, $pass){
        $user = User::getOneWhere('login', $login);
        //TODO сделать через password_verify() и захешировать пароль в БД
        if($user->pass == $pass){
            $_SESSION['login'] = $login;
            return true;
        }else{
            return false;
        }
    }

    public static function getTableName()
    {
        return "users";
    }


}