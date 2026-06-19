<?php

namespace Models;

use PDO;
use PDOException;

class Database
{
    private static ?Database $instance = null;

    private PDO $pdo;

    private function __construct()
    {
        $config = require __DIR__ . '/../../config/database.php';

        $dsn = sprintf(
            "pgsql:host=%s;port=%s;dbname=%s;sslmode=require",
            $config['host'],
            $config['port'],
            $config['database']
        );

        try {

            $this->pdo = new PDO(

                $dsn,

                $config['username'],

                $config['password'],

                [

                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,

                    PDO::ATTR_EMULATE_PREPARES => false

                ]

            );

        } catch (PDOException $e) {

            die("Database Error : ".$e->getMessage());

        }
    }

    public static function instance(): Database
    {
        if (self::$instance === null) {

            self::$instance = new self();

        }

        return self::$instance;
    }

    public function pdo(): PDO
    {
        return $this->pdo;
    }

    public function query(string $sql, array $params = [])
    {
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($params);

        return $stmt;
    }

    public function fetch(string $sql, array $params = [])
    {
        return $this->query($sql,$params)->fetch();
    }

    public function fetchAll(string $sql, array $params = [])
    {
        return $this->query($sql,$params)->fetchAll();
    }

    public function execute(string $sql,array $params=[])
    {
        return $this->query($sql,$params)->rowCount();
    }

    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

    public function beginTransaction()
    {
        return $this->pdo->beginTransaction();
    }

    public function commit()
    {
        return $this->pdo->commit();
    }

    public function rollback()
    {
        return $this->pdo->rollBack();
    }
}