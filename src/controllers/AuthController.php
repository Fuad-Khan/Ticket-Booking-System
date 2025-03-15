<?php

error_reporting(E_ALL); // Report all errors
ini_set('display_errors', 1); // Display errors to the screen

require_once __DIR__ . '/../model/User.php';


require_once __DIR__ . '/../utils/Helpers.php';
require_once __DIR__ . '/../utils/Session.php';

class AuthController
{
    // Show login form
    public static function showLoginForm()
    {
        require_once __DIR__ . '/../public/login.php';
    }

    // Show registration form
    public static function showRegisterForm()
    {
        require_once __DIR__ . '/../public/register.php';
    }

    // Handle user registration
    public static function registerUser($name, $email, $phone, $password)
    {
        // Validate the inputs
        if (!Helpers::validateEmail($email)) {
            return "Invalid email address.";
        }

        if (!Helpers::validatePhone($phone)) {
            return "Invalid phone number.";
        }

        if (!Helpers::validatePassword($password)) {
            // return "Password must be at least 8 characters long, contain an uppercase letter, a number, and a special character.";

            return "Password must be at least 4 characters long.";
        }

        // Check if the email or phone is already registered
        if (User::isEmailRegistered($email)) {
            return "Email is already registered.";
        }

        if (User::isPhoneRegistered($phone)) {
            return "Phone number is already registered.";
        }

        // Register the user
        $registrationSuccess = User::registerUser($name, $email, $phone, $password);

        if ($registrationSuccess) {
            return "Registration successful. Please log in.";
        } else {
            return "Registration failed. Please try again.";
        }
    }

    public static function handleRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = Helpers::sanitize($_POST['name']);
            $email = Helpers::sanitize($_POST['email']);
            $phone = Helpers::sanitize($_POST['phone']);
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            $error = self::registerUser($name, $email, $phone, $password, $confirm_password);

            if (empty($error)) {
                Helpers::redirect('/login.php?registered=true'); // Redirect to login page after successful registration
            } else {
                require_once __DIR__ . '/../public/register.php';
            }
        }
    }

    // Handle user login
    public static function loginUser($emailOrPhone, $password)
    {
        // Ensure that $emailOrPhone is passed correctly
        if (Helpers::validateEmail($emailOrPhone)) {
            // If it's an email, find the user by email
            $user = User::getUserByEmail($emailOrPhone);
        } elseif (Helpers::validatePhone($emailOrPhone)) {
            // If it's a phone number, find the user by phone number
            $user = User::getUserByPhone($emailOrPhone);
        } else {
            return "Invalid email or phone number.";
        }
    
        // Check if the user exists
        if (!$user) {
            return "No account found with that email or phone number.";
        }
    
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            Session::set('user_id', $user['user_id']);
            Session::set('user_name', $user['name']);
            Session::set('user_email', $user['email']);
            Session::set('user_phone', $user['phone']);
    
            // Redirect to the referrer URL or homepage if no referrer
            $redirectUrl = isset($_SESSION['redirect_url']) ? $_SESSION['redirect_url'] : 'index.php';
    
            // Clear the redirect URL session after use
            unset($_SESSION['redirect_url']);
    
            // Redirect to the URL
            Helpers::redirect($redirectUrl);
            exit();
        } else {
            return "Incorrect password.";
        }
    }
    

    // Handle user logout
    public static function logoutUser()
    {
        // Destroy the session
        Session::destroy();

        // Redirect to the homepage
        Helpers::redirect('/index.php');
    }

    // Check if user is logged in (for protected pages)
    public static function checkLogin()
    {
        if (!Session::exists('user_id')) {
            // Redirect to login page if not logged in
            Helpers::redirect('/login.php');
        }
    }

    // Show forgot password form
    public static function showForgotPasswordForm()
    {
        require_once __DIR__ . '/../public/forgot-password.php';
    }

    // Handle password recovery (send password reset email)
    public static function recoverPassword($email)
    {
        if (!Helpers::validateEmail($email)) {
            return "Invalid email address.";
        }

        // Check if the user exists
        $user = User::getUserByEmail($email);

        if (!$user) {
            return "No account found with that email.";
        }

        // Generate a password reset token
        $token = bin2hex(random_bytes(50));

        // Store the token in the database (for the sake of simplicity, assuming `password_reset` table exists)
        // In real systems, this would be stored in a password reset table in the database
        // User::storePasswordResetToken($email, $token);

        // Send the reset token to the user via email (this example uses a simple mail function)
        $resetLink = "https://yourdomain.com/reset-password.php?token=$token";

        // You can use the Mailer class to send the email, here we are simulating it
        mail($email, "Password Reset Request", "Click the following link to reset your password: $resetLink");

        return "A password reset link has been sent to your email.";
    }

    // Handle password reset (change password)
    public static function resetPassword($token, $newPassword)
    {
        // Validate the new password
        if (!Helpers::validatePassword($newPassword)) {
            return "Password must be at least 8 characters long, contain an uppercase letter, a number, and a special character.";
        }

        // Validate the token (for simplicity, assuming token is valid)
        // In a real application, you would verify the token from the database
        // User::verifyPasswordResetToken($token);

        // Reset the password (assuming email and token are valid)
        // User::updatePassword($email, $newPassword);

        // After successful reset, the user should log in again
        return "Your password has been reset successfully.";
    }
}
