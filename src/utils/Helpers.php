<?php
class Helpers {
    // Redirect to a specific URL
    public static function redirect($url) {
        header("Location: $url");
        exit();
    }

    // Sanitize input data
    public static function sanitize($data) {
        if (is_array($data)) {
            return array_map([self::class, 'sanitize'], $data);
        }
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }

    // Generate a random token (e.g., for CSRF or password reset)
    public static function generateToken($length = 32) {
        return bin2hex(random_bytes($length));
    }

    // Check if a string is a valid email
    public static function isValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    // Format a date (e.g., "2023-10-15" to "October 15, 2023")
    public static function formatDate($date, $format = 'F j, Y') {
        return date($format, strtotime($date));
    }
}
?>