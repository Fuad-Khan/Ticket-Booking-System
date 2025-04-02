<?php


class Database {
    private static $pdo;

    public static function connect() {
        try {
            if (self::$pdo === null) {
                // Load environment variables manually
                $envPath = dirname(__DIR__) . '/.env';
                if (file_exists($envPath)) {
                    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                    foreach ($lines as $line) {
                        if (strpos(trim($line), '#') === 0) {
                            continue;
                        }
                        list($name, $value) = explode('=', $line, 2);
                        $_ENV[trim($name)] = trim($value);
                    }
                }

                self::$pdo = new PDO(
                    "mysql:host=" . ($_ENV['DB_HOST'] ?? 'localhost') . 
                    ";dbname=" . ($_ENV['DB_NAME'] ?? 'bus_booking'),
                    $_ENV['DB_USER'] ?? 'root',
                    $_ENV['DB_PASSWORD'] ?? ''
                );
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return self::$pdo;
        } catch (PDOException $e) {
            throw new Exception("Database connection failed: " . $e->getMessage());
        }
    }
}

?>