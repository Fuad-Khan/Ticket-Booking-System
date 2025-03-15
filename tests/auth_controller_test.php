<?php

error_reporting(E_ALL); // Report all errors
ini_set('display_errors', 1); // Display errors to the screen

require_once __DIR__ . '/../src/utils/Session.php';
require_once __DIR__ . '/../src/utils/Helpers.php';
require_once __DIR__ . '/../src/controllers/AuthController.php';

// Mocking User class functions
class UsersController {
    public static function isEmailRegistered($email) {
        return $email === 'test@example.com';
    }

    public static function isPhoneRegistered($phone) {
        return $phone === '+1234567890';
    }

    public static function getUserByEmail($email) {
        if ($email === 'test@example.com') {
            return ['user_id' => 1, 'name' => 'Test User', 'email' => $email, 'phone' => '+1234567890', 'password' => password_hash('Test@123', PASSWORD_DEFAULT)];
        }
        return null;
    }
    
    public static function getUserByPhone($phone) {
        if ($phone === '+1234567890') {
            return ['user_id' => 1, 'name' => 'Test User', 'email' => 'test@example.com', 'phone' => $phone, 'password' => password_hash('Test@123', PASSWORD_DEFAULT)];
        }
        return null;
    }

    public static function registerUser($name, $email, $phone, $password) {
        return true; // Simulating successful registration
    }
}

// Test cases
function runTests() {
    echo "Testing User Registration:<br>";
    
    $result = AuthController::registerUser('New User', 'newuser@example.com', '+9876543210', 'Pass@123');
    echo $result === "Registration successful. Please log in." ? "PASS<br>" : "FAIL: $result<br>";
    
    $result = AuthController::registerUser('New User', 'test@example.com', '+9876543210', 'Pass@123');
    echo $result === "Email is already registered." ? "PASS<br>" : "FAIL: $result<br>";
    
    $result = AuthController::registerUser('New User', 'invalid-email', '+9876543210', 'Pass@123');
    echo $result === "Invalid email address." ? "PASS<br>" : "FAIL: $result<br>";

    echo "<br>Testing User Login:<br>";
    
    $result = AuthController::loginUser('test@example.com', 'Test@123');
    echo $result === null ? "PASS<br>" : "FAIL: $result<br>";
    
    $result = AuthController::loginUser('test@example.com', 'WrongPass');
    echo $result === "Incorrect password." ? "PASS<br>" : "FAIL: $result<br>";
    
    $result = AuthController::loginUser('invalid@example.com', 'Test@123');
    echo $result === "No account found with that email or phone number." ? "PASS<br>" : "FAIL: $result<br>";
}

runTests();

?>