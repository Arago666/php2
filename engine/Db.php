<?php

namespace app\engine;

use app\traits\Tsingletone;

class Db
{

    use Tsingletone;

    private $config = [
        'driver' => 'mysql',
        'host' => 'localhost',
        'login' => 'root',
        'password' => '',
        'database' => 'test',
        'charset' => 'utf8'
    ];

    private $connection = null;

    private function getConnection(){
        if(is_null($this->connection)){
            $this->connection = new \PDO($this->prepereDsnString(),
                $this->config['login'],
                $this->config['password']
            );
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        return $this->connection;
    }

    private function prepereDsnString(){
        return sprintf("%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset'],
        );
    }

    public function queryLimit($sql, $page){
        $pdoStatement = $this->getConnection()->prepare($sql);
        $pdoStatement->bindValue(1,$page, \PDO::PARAM_INT);
        $pdoStatement->execute();
        return $pdoStatement->fetchAll();
//        $pdoStatement->execute($params);
//        return $pdoStatement;
    }

    public function queryObject($sql, $params, $class){
        $statement = $this->query($sql, $params);
        $statement->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
//        return $statement->fetch();
        $obj = $statement->fetch();
        if(!$obj){
            throw new \Exception("Продукт не найден", 404);
        }
        return $obj;
    }

    private function query($sql, $params){
        $pdoStatement = $this->getConnection()->prepare($sql);
        $pdoStatement->execute($params);
        return $pdoStatement;
    }

    public function execute($sql, $params){
        return $this->query($sql, $params);
    }

    public function lastInsertId(){
        return $this->connection->lastInsertId();
    }

    public function queryOne($sql, $params = [])
    {
        return $this->query($sql, $params)->fetch();
    }

    public function queryAll($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchAll();
    }

}