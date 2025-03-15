<?php

class Helpers {

    // Redirect to a URL with optional delay
    public static function redirect($url, $delay = 0) {
        if ($delay > 0) {
            header("Refresh: $delay; url=$url");
        } else {
            header("Location: $url");
        }
        exit();
    }

    // Sanitize input data to prevent XSS and other security vulnerabilities
    public static function sanitize($data) {
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }

    // Validate an email address
    public static function validateEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Check if the domain part is a valid domain
            list($username, $domain) = explode('@', $email);
            if (checkdnsrr($domain, 'MX')) {
                return true;
            }
        }
        return false;
    }

    // Validate a phone number (more flexible, allowing international formats)
    public static function validatePhone($phone) {
        return preg_match('/^\+?[0-9]{1,4}?[-.●]?[0-9]{1,15}$/', $phone);
    }

    // Validate a strong password (minimum 8 characters, at least one uppercase letter, one number, and one special character)
    // public static function validatePassword($password) {
    //     return preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{4,}$/', $password);
    // }

    public static function validatePassword($password) {
        return strlen($password) >= 4;
    }
}

?>
