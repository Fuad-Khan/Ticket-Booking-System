<?php
// src/config/database.php

class Database {  
    private static $pdo;  

    public static function connect() {  
        try {  
            if (self::$pdo === null) {  
                self::$pdo = new PDO(  
                    "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'],  
                    $_ENV['DB_USER'],  
                    $_ENV['DB_PASSWORD']  
                );  
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            }  
            return self::$pdo;  
        } catch (PDOException $e) {  
            error_log("Database connection failed: " . $e->getMessage());
            header('Location: /500.php');
            exit();  
        }  
    }  
}