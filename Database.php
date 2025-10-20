<?php
class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        $host = 'examenpizza-db-1'; // Cambia por el nombre de tu contenedor
        $dbname = 'pizzeria'; 
        $username = 'root'; 
        $password = 'root'; 
        $port = 3306;
    
        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
        try {
            $this->connection = new PDO($dsn, $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}


