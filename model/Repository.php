<?php


namespace app\model;


use app\engine\Db;
use app\interfaces\IModel;

abstract class Repository implements IModel
{
    public function getOneWhere($field, $value){
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE `{$field}`=:value";
        return Db::getInstance()->queryObject($sql, ['value' => $value], $this->getEntityClass());
    }


    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->queryObject($sql, ['id' => $id], $this->getEntityClass());
    }

    //TODO сделать похожий метод getSummWhere
    public function getCountWhere($field, $value){
        $tableName = $this->getTableName();
        $sql = "SELECT count(id) as count FROM {$tableName} WHERE {$field} = :value";
        return DB::getInstance()->queryOne($sql, ["value" => $value])['count'];
    }

    public function getJoin($table1, $table2, $id1, $id2){
        //  Db::table('basket')->where('name', 'admin')->andwhere('login','123')->get();
    }

    public function getLimit($page){
        $tableName = $this->getTableName();
//        $sql = "SELECT * FROM {$tableName} LIMIT :page";
        $sql = "SELECT * FROM {$tableName} LIMIT ?";
        return DB::getInstance()->queryLimit($sql, $page);

        //db2_bind_param()
        //return Db::getInstance()->queryLimit();
        //TODO доделать getlimit

    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);
    }

    public function insert(Model $entity)
    {
        //TODO в идеале, сформировавшийся запрос должен содержать только изменившиеся поля
        $params = [];
        $columns = [];
//        foreach ($this as $key=>$value){
        foreach ($entity->props as $key=>$value){
//            $params[":$key"] = $value;
            $params[":$key"] = $entity->$key;
            $columns[] = "`$key`";
        }

        $columns = implode(", ", $columns);
        $values = implode(", ", array_keys($params));

        $sql = "INSERT INTO {$this->getTableName()} ({$columns}) VALUES ({$values})";

        Db::getInstance()->execute($sql,$params);

        $entity->id = Db::getInstance()->lastInsertId();

    }

    public function update(Model $entity){
        $params = [];
        $values = [];

        foreach ($entity->props as $key=>$value) {
            if(!$value) continue;
            $params[":$key"] = $this->$key;
            $values[] = "`$key`" . " = " .  ":$key";
            $entity->props[$key] = false;
        }
        $params[":id"] = $entity->id;
        $updateString = implode(", ", $values);
        $sql = "UPDATE {$this->getTableName()} SET {$updateString} WHERE id = :id";
        Db::getInstance()->execute($sql,$params);
    }

    public function delete(Model $entity){
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->execute($sql, ['id'=>$entity->id])->rowCount();
    }

    public function save(Model $entity){
        if(is_null($entity->id)){
            $this->insert($entity);
        }
        else{
            $this->update($entity);
        }
    }

    abstract public function getTableName();

}