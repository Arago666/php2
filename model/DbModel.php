<?php


namespace app\model;
use app\engine\Db;

abstract class DbModel extends Model
{

    public static function getOne($id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->queryObject($sql, ['id' => $id], static::class);
    }

    public static function getLimit($to){
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT 0, :to";
        //db2_bind_param()
        //return Db::getInstance()->queryLimit();
        //TODO доделать getlimit

    }

    public static function getAll()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }

    public function insert()
    {
        $params = [];
        $columns = [];
        foreach ($this as $key=>$value){
            if($key == 'id') continue;
            $params[":$key"] = $value;
            $columns[] = "`$key`";
        }

        $columns = implode(", ", $columns);
        $values = implode(", ", array_keys($params));

        $sql = "INSERT INTO {$this->getTableName()} ({$columns}) VALUES ({$values})";

        Db::getInstance()->execute($sql,$params);

        $this->id = Db::getInstance()->lastInsertId();
    }

    public function update(){
        //TODO сделать UPDATE в идеале, сформировавшийся запрос должен содержать только изменившиеся поля
        //сделал, проверить как сделает преподователь
        $params = [];
        $values = [];
        foreach($this as $key=>$value){
            $params[":$key"] = $value;
            if($key == 'id') continue;
            $values[] = "`$key`" . " = " .  ":$key";
        }
        $updateString = implode(", ", $values);
        $sql = "UPDATE {$this->getTableName()} SET {$updateString} WHERE id = :id";
        Db::getInstance()->execute($sql,$params);
    }

    public function delete(){
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->execute($sql, ['id'=>$this->id])->rowCount();
    }

    public function save(){
        if(is_null($this->id)){
            $this->insert();
        }
        else{
            $this->update();
        }
    }

    abstract static public function getTableName();
}