<?php

// Including necessary files
require_once __DIR__ . '/../../src/controllers/AuthController.php';
require_once __DIR__ . '/../../src/models/User.php';
require_once __DIR__ . '/../../src/utils/Helpers.php';
require_once __DIR__ . '/../../src/utils/Session.php';
require_once __DIR__ . '/../../config/database.php';

// Function to simulate the redirect
function testRedirect($url) {
    echo "Redirected to: " . $url . "\n";
}

// Custom function to simulate assertions
function assertTrue($condition, $message = '') {
    if (!$condition) {
        echo "FAILED: " . $message . "\n";
    } else {
        echo "PASSED: " . $message . "\n";
    }
}

function assertFalse($condition, $message = '') {
    if ($condition) {
        echo "FAILED: " . $message . "\n";
    } else {
        echo "PASSED: " . $message . "\n";
    }
}

function assertEquals($expected, $actual, $message = '') {
    if ($expected !== $actual) {
        echo "FAILED: $message. Expected: $expected, but got: $actual\n";
    } else {
        echo "PASSED: $message\n";
    }
}

// Test suite for AuthController
class AuthControllerTest {

    // Test the registerUser method
    public function testRegisterUser() {
        $name = "John Doe";
        $email = "johndoe@example.com";
        $phone = "+123456789";
        $password = "Password123!";

        // Assume that the registration was successful
        $result = AuthController::registerUser($name, $email, $phone, $password);
        assertTrue($result, "User registration should succeed");
    }

    // Test the isEmailRegistered method for a new email
    public function testIsEmailRegistered() {
        $email = "johndoe@example.com";

        // Check if the email exists
        $result = User::isEmailRegistered($email);
        assertTrue($result, "Email should be registered");
    }

    // Test the login functionality with valid credentials
    public function testLoginValidUser() {
        $email = "johndoe@example.com";
        $password = "Password123!";

        // Simulate login
        $user = AuthController::loginUser($email, $password);
        assertTrue($user !== null, "Login should succeed with correct credentials");
    }

    // Test login with incorrect password
    public function testLoginInvalidPassword() {
        $email = "johndoe@example.com";
        $password = "WrongPassword";

        // Simulate login
        $user = AuthController::loginUser($email, $password);
        assertFalse($user !== null, "Login should fail with incorrect password");
    }

    // Test user session after login
    public function testSessionAfterLogin() {
        $email = "johndoe@example.com";
        $password = "Password123!";

        // Simulate login and session start
        AuthController::loginUser($email, $password);
        $sessionId = Session::get('user_id');

        assertTrue($sessionId !== null, "Session should be started after login");
    }

    // Test logout functionality
    public function testLogout() {
        // Simulate logging out
        AuthController::logoutUser();
        $sessionId = Session::get('user_id');

        assertTrue($sessionId === null, "Session should be cleared after logout");
    }

    // Test the isPhoneRegistered method for a new phone number
    public function testIsPhoneRegistered() {
        $phone = "+123456789";

        // Check if the phone number exists
        $result = User::isPhoneRegistered($phone);
        assertTrue($result, "Phone number should be registered");
    }

    // Test the validateEmail helper method
    public function testValidateEmail() {
        $validEmail = "valid@example.com";
        $invalidEmail = "invalid-email";

        assertTrue(Helpers::validateEmail($validEmail), "Valid email should pass");
        assertFalse(Helpers::validateEmail($invalidEmail), "Invalid email should fail");
    }

    // Test the validatePhone helper method
    public function testValidatePhone() {
        $validPhone = "+123456789";
        $invalidPhone = "12345";

        assertTrue(Helpers::validatePhone($validPhone), "Valid phone should pass");
        assertFalse(Helpers::validatePhone($invalidPhone), "Invalid phone should fail");
    }

    // Test the validatePassword helper method
    public function testValidatePassword() {
        $validPassword = "Password123!";
        $invalidPassword = "password";

        assertTrue(Helpers::validatePassword($validPassword), "Valid password should pass");
        assertFalse(Helpers::validatePassword($invalidPassword), "Invalid password should fail");
    }
}

// Running the test suite
$test = new AuthControllerTest();

echo "Running tests...\n";

$test->testRegisterUser();
$test->testIsEmailRegistered();
$test->testLoginValidUser();
$test->testLoginInvalidPassword();
$test->testSessionAfterLogin();
$test->testLogout();
$test->testIsPhoneRegistered();
$test->testValidateEmail();
$test->testValidatePhone();
$test->testValidatePassword();

echo "Test suite finished.\n";

?>
