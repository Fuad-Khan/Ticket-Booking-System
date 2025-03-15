<?php

// Session class (no duplicate)
class Session {
    // Start the session if not already started
    public static function start() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();

            // Regenerate session ID to prevent session fixation
            if (!self::exists('session_regenerated')) {
                session_regenerate_id(true);
                self::set('session_regenerated', true); // Mark session as regenerated
            }
        }
    }

    // Set a session variable
    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    // Get a session variable
    public static function get($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    // Check if a session variable exists
    public static function exists($key) {
        return isset($_SESSION[$key]);
    }

    // Unset a session variable
    public static function delete($key) {
        if (self::exists($key)) {
            unset($_SESSION[$key]);
        }
    }

    // Destroy the session
    public static function destroy() {
        session_unset();
        session_destroy();
        // Optionally clear the session cookie as well
        setcookie(session_name(), '', time() - 3600, '/'); // Expire the session cookie
    }

    // Redirect to a given URL
    public static function redirect($url) {
        header("Location: $url");
        exit();
    }
}
?>
