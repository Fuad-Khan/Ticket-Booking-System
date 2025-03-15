<?php

require_once '../src/config/database.php';

function testDatabaseConnection() {
    try {
        $pdo = Database::connect();
        echo "Database connection successful.ok\n";
    } catch (PDOException $e) {
        echo "Database connection failed: " . $e->getMessage() . "\n";
    }
}

testDatabaseConnection();
?>
