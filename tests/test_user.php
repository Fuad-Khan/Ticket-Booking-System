<?php
// tests/UserModelTest.php

error_reporting(E_ALL); // Report all errors
ini_set('display_errors', 1); // Display errors to the screen

require_once __DIR__ . '/../src/config/database.php';
require_once __DIR__ . '/../src/model/User.php';

// Database connection check
function testDatabaseConnection() {
    try {
        $pdo = Database::connect();
        echo "<br>Database connection successful.<br>";
    } catch (PDOException $e) {
        echo "Database connection failed: " . $e->getMessage() . "<br>";
    }
}

testDatabaseConnection();

// Test 1: Create a new user (Register)
echo "<br>Test 1: Register a new user<br>";
$name = "MMMM";
$email = "mmmm@gmail";
$phone = "12345";
$password = "0000";
$registerResult = User::registerUser($name, $email, $phone, $password);
if ($registerResult) {
    echo "User registered successfully.<br>";
} else {
    echo "Failed to register user.<br>";
}

// Test 2: Read user by email (Login)
echo "<br>Test 2: Read user by email<br>";
$user = User::getUserByEmail($email);
if ($user) {
    echo "User found:<br>";
    echo "<pre>"; print_r($user); echo "</pre>";
} else {
    echo "User not found.<br>";
}

// Test 3: Update user details (Update name and phone)
echo "<br>Test 3: Update user details<br>";
$newName = "John Updated";
$newPhone = "0987654321";
$updateResult = User::updateUser($user['user_id'], $newName, $email, $newPhone, "newpassword123");
if ($updateResult) {
    echo "User details updated successfully.<br>";
} else {
    echo "Failed to update user details.<br>";
}

// Test 4: Read updated user by user ID
echo "<br>Test 4: Read updated user details<br>";
$updatedUser = User::getUserById($user['user_id']);
if ($updatedUser) {
    echo "Updated user details:<br>";
    echo "<pre>"; print_r($updatedUser); echo "</pre>";
} else {
    echo "User not found.<br>";
}

// Test 5: Delete user
echo "<br>Test 5: Delete user<br>";
$deleteResult = User::deleteUser($user['user_id']);
if ($deleteResult) {
    echo "User deleted successfully.<br>";
} else {
    echo "Failed to delete user.<br>";
}

// Test 6: Try to read user after deletion
echo "<br>Test 6: Try to read user after deletion<br>";
$deletedUser = User::getUserById($user['user_id']);
if ($deletedUser) {
    echo "User found:<br>";
    echo "<pre>"; print_r($deletedUser); echo "</pre>";
} else {
    echo "User not found (as expected, since user is deleted).<br>";
}
?>