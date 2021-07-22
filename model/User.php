<?php

namespace app\model;

class User extends DbModel
{
    //TODO перевести в протектед и добавить массив свойст
    public $id;
    public $login;
    public $pass;

    public function __construct($login = null, $pass = null)
    {
        $this->login = $login;
        $this->pass = $pass;
    }

    public static function getTableName()
    {
        return "users";
    }


}