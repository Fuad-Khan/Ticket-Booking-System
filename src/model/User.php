<?php

require_once __DIR__ . '/../config/database.php';

class User
{
    // Register a new user
    public static function registerUser($name, $email, $phone, $password)
    {
        $pdo = Database::connect();  // Ensure the PDO connection is initialized

        try {
            // Hash the password
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            // Prepare SQL query to insert user data
            $stmt = $pdo->prepare("INSERT INTO Users (name, email, phone, password) 
                                   VALUES (:name, :email, :phone, :password)");

            // Bind parameters
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':password', $passwordHash);

            // Execute the query
            return $stmt->execute();
        } catch (PDOException $e) {
            // Catch any error and display it
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Get user by email (for login)
    public static function getUserByEmail($email)
    {
        $pdo = Database::connect();  // Ensure the PDO connection is initialized

        try {
            // Prepare SQL query to select user by email
            $stmt = $pdo->prepare("SELECT * FROM Users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            // Fetch the user data
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Catch any error and display it
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public static function getUserByPhone($phone)
{
    $pdo = Database::connect();  // Ensure the PDO connection is initialized

    try {
        // Prepare SQL query to select user by phone number
        $stmt = $pdo->prepare("SELECT * FROM Users WHERE phone = :phone");
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();

        // Fetch the user data
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Catch any error and display it
        echo "Error: " . $e->getMessage();
        return null;
    }
}


    // Get user by user_id (to fetch user details)
    public static function getUserById($userId)
    {
        $pdo = Database::connect();  // Ensure the PDO connection is initialized

        try {
            // Prepare SQL query to select user by user_id
            $stmt = $pdo->prepare("SELECT * FROM Users WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();

            // Fetch the user data
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Catch any error and display it
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    // Update user information (for profile update)
    public static function updateUser($userId, $name, $email, $phone, $password = null)
    {
        $pdo = Database::connect();  // Ensure the PDO connection is initialized

        try {
            // If password is provided, hash it, else keep the old password
            $passwordHash = $password ? password_hash($password, PASSWORD_DEFAULT) : null;

            // Prepare SQL query to update user data
            $query = "UPDATE Users SET name = :name, email = :email, phone = :phone";

            if ($password) {
                $query .= ", password = :password";
            }

            $query .= " WHERE user_id = :user_id";

            // Prepare the statement
            $stmt = $pdo->prepare($query);

            // Bind parameters
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            if ($password) {
                $stmt->bindParam(':password', $passwordHash);
            }
            $stmt->bindParam(':user_id', $userId);

            // Execute the query
            return $stmt->execute();
        } catch (PDOException $e) {
            // Catch any error and display it
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Delete user (for account deletion)
    public static function deleteUser($userId)
    {
        $pdo = Database::connect();  // Ensure the PDO connection is initialized

        try {
            // Prepare SQL query to delete user
            $stmt = $pdo->prepare("DELETE FROM Users WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $userId);

            // Execute the query
            return $stmt->execute();
        } catch (PDOException $e) {
            // Catch any error and display it
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Check if an email is already registered (for registration validation)
    public static function isEmailRegistered($email)
    {
        $pdo = Database::connect();  // Ensure the PDO connection is initialized

        try {
            // Prepare SQL query to check if the email exists
            $stmt = $pdo->prepare("SELECT * FROM Users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            // Return true if email is found, false otherwise
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            // Catch any error and display it
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Check if a phone number is already registered (for registration validation)
    public static function isPhoneRegistered($phone)
    {
        $pdo = Database::connect();  // Ensure the PDO connection is initialized

        try {
            // Prepare SQL query to check if the phone number exists
            $stmt = $pdo->prepare("SELECT * FROM Users WHERE phone = :phone");
            $stmt->bindParam(':phone', $phone);
            $stmt->execute();

            // Return true if phone is found, false otherwise
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            // Catch any error and display it
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Get all users (for admin panel or user management)
    public static function getAllUsers()
    {
        $pdo = Database::connect();  // Ensure the PDO connection is initialized

        try {
            // Prepare SQL query to select all users
            $stmt = $pdo->prepare("SELECT * FROM Users");
            $stmt->execute();

            // Fetch all user data
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Catch any error and display it
            echo "Error: " . $e->getMessage();
            return null;
        }
    }
}

?>
