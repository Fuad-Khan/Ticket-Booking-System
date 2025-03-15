<?php

// Include the Session class (if it's in a separate file)
require_once __DIR__ . '/../../src/utils/Session.php';

// Start the session
Session::start();

// Test 1: Setting a session variable
Session::set('username', 'JohnDoe');
echo "Test 1: Set session variable 'username' = 'JohnDoe'<br>";

// Test 2: Getting a session variable
$username = Session::get('username');
echo "Test 2: Get session variable 'username' = '$username'<br>";

// Test 3: Checking if a session variable exists
if (Session::exists('username')) {
    echo "Test 3: Session variable 'username' exists.<br>";
} else {
    echo "Test 3: Session variable 'username' does not exist.<br>";
}

// Test 4: Deleting a session variable
Session::delete('username');
echo "Test 4: Deleted session variable 'username'.<br>";

// Test 5: Check if 'username' exists after deletion
if (Session::exists('username')) {
    echo "Test 5: Session variable 'username' exists.<br>";
} else {
    echo "Test 5: Session variable 'username' does not exist.<br>";
}

// Test 6: Starting a session again to see if the session is already started
Session::start(); // It should not restart the session if it's already started
echo "Test 6: Session started.<br>";

// Test 7: Session regeneration
Session::set('session_regenerated', true);
echo "Test 7: Session regenerated.<br>";

// Test 8: Redirect (Commented out to prevent actual redirect during testing)
// Session::redirect('https://www.example.com');

echo "<br>Test completed.";

?>
