<?php


namespace app\model;
use app\engine\Db;

abstract class DbModel extends Model
{

//    private $tableName;

    public static function getOne($id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->queryObject($sql, ['id' => $id], static::class);
    }

    public static function getJoin($table1, $table2, $id1, $id2){
      //  Db::table('basket')->where('name', 'admin')->andwhere('login','123')->get();
    }

    public static function getLimit($page){
        $tableName = static::getTableName();
//        $sql = "SELECT * FROM {$tableName} LIMIT :page";
        $sql = "SELECT * FROM {$tableName} LIMIT ?";
        return DB::getInstance()->queryLimit($sql, $page);

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
        //TODO в идеале, сформировавшийся запрос должен содержать только изменившиеся поля
        $params = [];
        $columns = [];
//        foreach ($this as $key=>$value){
        foreach ($this->props as $key=>$value){
//            $params[":$key"] = $value;
            $params[":$key"] = $this->$key;
            $columns[] = "`$key`";
        }

        $columns = implode(", ", $columns);
        $values = implode(", ", array_keys($params));

        $sql = "INSERT INTO {$this->getTableName()} ({$columns}) VALUES ({$values})";

        Db::getInstance()->execute($sql,$params);

        $this->id = Db::getInstance()->lastInsertId();

    }

    public function update(){
        $params = [];
        $values = [];

        foreach ($this->props as $key=>$value) {
            if(!$value) continue;
            $params[":$key"] = $this->$key;
            $values[] = "`$key`" . " = " .  ":$key";
            $this->props[$key] = false;
        }
        $params[":id"] = $this->id;
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