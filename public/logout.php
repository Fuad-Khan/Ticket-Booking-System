<?php
session_start();
require_once __DIR__ . '/../src/utils/Session.php';
require_once __DIR__ . '/../src/utils/Helpers.php';

// Destroy the session and redirect to login page
Session::destroySession();
Helpers::redirect('/login.php');
?>