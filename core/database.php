<?php

class Database {
    private $connection;

    public function __construct() {
        try {
            $this->connection = new PDO("mysql:host=localhost;dbname=a223536", "root", "");
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Database connection failed: " . $e->getMessage();
            exit;
        }
    }

    public function getConnection() {
        return $this->connection;
    }
}

?>
