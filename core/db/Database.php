<?php

namespace app\core\db;

use PDOException;

class Database
{
    public \PDO $pdo;

    public function __construct($dbConfig = [])
    {
        $dbDsn = $dbConfig['dsn'] ?? '';
        $username = $dbConfig['user'] ?? '';
        $password = $dbConfig['password'] ?? '';
        try {
            $this->pdo = new \PDO($dbDsn, $username, $password);
            // set the PDO error mode to exception
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function prepare($sql): \PDOStatement
    {
        return $this->pdo->prepare($sql);
    }
}