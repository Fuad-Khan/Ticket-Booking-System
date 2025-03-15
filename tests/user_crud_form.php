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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $name = $_POST['name'] ?? '';  // Check if the value exists
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $password = $_POST['password'] ?? '';
    $userId = $_POST['user_id'] ?? null;

    // Create user
    if ($action == 'create') {
        if (User::registerUser($name, $email, $phone, $password)) {
            echo '<div class="alert alert-success">User registered successfully!</div>';
        } else {
            echo '<div class="alert alert-danger">User registration failed!</div>';
        }
    }

    // Update user
    if ($action == 'update' && $userId) {
        if (User::updateUser($userId, $name, $email, $phone, $password)) {
            echo '<div class="alert alert-success">User details updated successfully!</div>';
        } else {
            echo '<div class="alert alert-danger">User update failed!</div>';
        }
    }

    // Delete user
    if ($action == 'delete' && $userId) {
        if (User::deleteUser($userId)) {
            echo '<div class="alert alert-success">User deleted successfully!</div>';
        } else {
            echo '<div class="alert alert-danger">User deletion failed!</div>';
        }
    }
}

// Fetch all users for Read operation
$users = User::getAllUsers();

// Pre-populate the form if updating an existing user
$userToUpdate = null;
if (isset($_GET['user_id'])) {
    $userToUpdate = User::getUserById($_GET['user_id']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User CRUD Operations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>User CRUD Operations</h2>
    
    <!-- Create or Update User Form -->
    <h3><?= $userToUpdate ? 'Update User' : 'Create User' ?></h3>
    <form action="user_crud_form.php" method="POST" class="mb-5">
        <input type="hidden" name="action" value="<?= $userToUpdate ? 'update' : 'create' ?>">
        <input type="hidden" name="user_id" value="<?= $userToUpdate ? $userToUpdate['user_id'] : '' ?>">

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $userToUpdate ? $userToUpdate['name'] : '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $userToUpdate ? $userToUpdate['email'] : '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?= $userToUpdate ? $userToUpdate['phone'] : '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" value="<?= $userToUpdate ? $userToUpdate['password'] : '' ?>" required>
        </div>
        <button type="submit" class="btn btn-primary"><?= $userToUpdate ? 'Update User' : 'Create User' ?></button>
    </form>

    <!-- Read Users List -->
    <h3>Existing Users</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['user_id'] ?></td>
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['phone'] ?></td>
                    <td>
                        <!-- Update User Form -->
                        <form action="user_crud_form.php" method="GET" class="d-inline">
                            <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                            <button type="submit" class="btn btn-warning">Update</button>
                        </form>
                        <!-- Delete User Form -->
                        <form action="user_crud_form.php" method="POST" class="d-inline">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>