<?php

namespace app\core\db;

use app\core\Application;
use PDO;
use PDOException;

abstract class DbModel
{
    abstract public static function tableName(): string;
    abstract public static function sort(): array;

    abstract public function primaryKey(): string;

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement = Application::$app->db->prepare("INSERT INTO $tableName (" . implode(",", $attributes) . ") 
                VALUES (" . implode(",", $params) . ")");
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();
        return true;
    }

    public static function findOne($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode("AND", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = Application::$app->db->prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }

    public static function findAll($limit, $offset)
    {
        try {
            $tableName = static::tableName();
            $sql = "SELECT * FROM $tableName ORDER BY published_at DESC LIMIT $offset, $limit";
            $statement = Application::$app->db->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_CLASS, static::class);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function findAllWithAssoc($limit, $offset)
    {
        try {
            $tableName = static::tableName();
            $order = static::sort();

            $sort = ($order) ? "ORDER BY " . implode(",", $order) : '';

            //TODO: refactoring the relations
            $sql = "SELECT $tableName.*, authors.name  FROM $tableName 
             inner join authors on posts.authorId = authors.id
             $sort LIMIT $offset, $limit";
            $statement = Application::$app->db->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}