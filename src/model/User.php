<?php
// src/model/User.php

require_once __DIR__ . '/../config/database.php';

class User
{
    // Insert user into the database
    public static function addUser($name, $email, $phone, $password)
    {
        global $pdo;

        // Hash the password before inserting it into the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {
            // Prepare SQL query to insert user data into the Users table
            $stmt = $pdo->prepare("INSERT INTO Users (name, email, phone, password) VALUES (:name, :email, :phone, :password)");

            // Bind the parameters
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':password', $hashed_password);

            // Execute the query
            $stmt->execute();

            return true; // User added successfully
        } catch (PDOException $e) {
            // Catch any error and return false
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Additional methods like fetching users, updating users, etc., can be added here
}
?>
