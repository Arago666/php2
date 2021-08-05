<?php


namespace app\model\repositories;


use app\model\entities\User;
use app\model\Repository;

class UserRepository extends Repository
{
    public function getEntityClass()
    {
        return User::class;
    }

    public function getTableName()
    {
        return "users";
    }

    public function isAuth(){
        return isset($_SESSION['login']);
    }

    public function getName(){
        return $_SESSION['login'];
    }

    public function auth($login, $pass){
        $user = static::getOneWhere('login', $login);
        //TODO сделать через password_verify() и захешировать пароль в БД
        if($user->pass == $pass){
            $_SESSION['login'] = $login;
            return true;
        }else{
            return false;
        }
    }

}