<?php

class Database {
    private static $host = 'localhost';
    private static $dbname = 'bus_booking';
    private static $username = 'root';  
    private static $password = '';      
    private static $pdo;

    public static function connect() {
        try {
            if (self::$pdo === null) {
                self::$pdo = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$dbname,
                    self::$username,
                    self::$password
                );
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return self::$pdo;
        } catch (PDOException $e) {
            echo "Database connection failed: " . $e->getMessage();
            exit();
        }
    }
}
?>
