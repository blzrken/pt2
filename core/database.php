<?php

class Database {
    private static $connection;

    public function getConnection() {
        if (self::$connection === null) {
            $configFile = __DIR__ . '/database.local.php';
            $config = is_file($configFile) ? require $configFile : [];
            $host = $config['host'] ?? (getenv('PT2_DB_HOST') ?: 'localhost');
            $database = $config['database'] ?? (getenv('PT2_DB_NAME') ?: 'a223536');
            $username = $config['username'] ?? (getenv('PT2_DB_USER') ?: 'root');
            $password = $config['password'] ?? (getenv('PT2_DB_PASSWORD') ?: '');
            $dsn = $config['dsn'] ?? (getenv('PT2_DB_DSN') ?: "mysql:host=$host;dbname=$database;charset=utf8mb4");
            self::$connection = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        }

        return self::$connection;
    }
}
