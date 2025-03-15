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
        echo "</br>Database connection successful.ok</br>";
    } catch (PDOException $e) {
        echo "Database connection failed: " . $e->getMessage() . "</br>";
    }
}

testDatabaseConnection();

// Test 1: Create a new user (Register)
echo "Test 1: Register a new user\n";
$name = "MMMM";
$email = "mmmm@gmail";
$phone = "12345";
$password = "0000";
$registerResult = User::registerUser($name, $email, $phone, $password);
if ($registerResult) {
    echo "User registered successfully.\n";
} else {
    echo "Failed to register user.\n";
}

// Test 2: Read user by email (Login)
echo "\nTest 2: Read user by email\n";
$user = User::getUserByEmail($email);
if ($user) {
    echo "User found: \n";
    print_r($user);
} else {
    echo "User not found.\n";
}

// Test 3: Update user details (Update name and phone)
echo "\nTest 3: Update user details\n";
$newName = "John Updated";
$newPhone = "0987654321";
$updateResult = User::updateUser($user['user_id'], $newName, $email, $newPhone, "newpassword123");
if ($updateResult) {
    echo "User details updated successfully.\n";
} else {
    echo "Failed to update user details.\n";
}

// Test 4: Read updated user by user ID
echo "\nTest 4: Read updated user details\n";
$updatedUser = User::getUserById($user['user_id']);
if ($updatedUser) {
    echo "Updated user details: \n";
    print_r($updatedUser);
} else {
    echo "User not found.\n";
}

// Test 5: Delete user
echo "\nTest 5: Delete user\n";
$deleteResult = User::deleteUser($user['user_id']);
if ($deleteResult) {
    echo "User deleted successfully.\n";
} else {
    echo "Failed to delete user.\n";
}

// Test 6: Try to read user after deletion
echo "\nTest 6: Try to read user after deletion\n";
$deletedUser = User::getUserById($user['user_id']);
if ($deletedUser) {
    echo "User found: \n";
    print_r($deletedUser);
} else {
    echo "User not found (as expected, since user is deleted).\n";
}
?>