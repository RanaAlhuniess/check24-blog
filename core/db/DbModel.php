<?php

namespace app\core\db;

use app\core\Application;

abstract class DbModel
{
    abstract public static function tableName(): string;
    public static function findOne($where)
    {
        $tableName = '';static::tableName();
        $attributes = array_keys($where);
        $sql = implode("AND", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = Application::$app->db->prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }
}