<?php

error_reporting(E_ALL); // Report all errors
ini_set('display_errors', 1); // Display errors to the screen


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
