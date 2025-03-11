<?php
class Session {
    // Start the session if not already started
    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Set a session variable
    public static function set($key, $value) {
        self::start();
        $_SESSION[$key] = $value;
    }

    // Get a session variable
    public static function get($key, $default = null) {
        self::start();
        return $_SESSION[$key] ?? $default;
    }

    // Check if a session variable exists
    public static function has($key) {
        self::start();
        return isset($_SESSION[$key]);
    }

    // Remove a session variable
    public static function remove($key) {
        self::start();
        if (self::has($key)) {
            unset($_SESSION[$key]);
        }
    }

    // Destroy the session
    public static function destroy() {
        self::start();
        session_destroy();
    }
}
?>