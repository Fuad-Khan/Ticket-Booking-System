<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set redirect URL if not logged in
session_start();
if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    header('Location: login.php');
    exit();
}

// Load controller
require_once __DIR__ . '/../src/controllers/AuthController.php';

// Initialize variables
$userData = [
    'name' => '',
    'email' => '',
    'phone' => ''
];
$message = '';
$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $result = AuthController::updateProfile(
            $_SESSION['user_id'],
            $_POST['name'],
            $_POST['email'],
            $_POST['phone']
        );
        
        if ($result === true) {
            $message = "Profile updated successfully!";
            // Refresh user data in session
            $_SESSION['user_name'] = $_POST['name'];
            $_SESSION['user_email'] = $_POST['email'];
            $_SESSION['user_phone'] = $_POST['phone'];
        } else {
            $error = $result;
        }
    } catch (Exception $e) {
        $error = "An error occurred: " . $e->getMessage();
    }
}

// Get current user data from session
$userData['name'] = $_SESSION['user_name'] ?? '';
$userData['email'] = $_SESSION['user_email'] ?? '';
$userData['phone'] = $_SESSION['user_phone'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Take Your Ticket</title>
    <link rel="stylesheet" href="assets/css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<?php include __DIR__ . '/../src/views/header.php'; ?>

<div class="profile-container">
    <h2>Update Profile</h2>
    
    <?php if (!empty($message)): ?>
        <div class="alert success">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>
    
    <?php if (!empty($error)): ?>
        <div class="alert error">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>
    
    <form action="profile.php" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" 
                   value="<?php echo htmlspecialchars($userData['name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" 
                   value="<?php echo htmlspecialchars($userData['email']); ?>" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" name="phone" id="phone" 
                   value="<?php echo htmlspecialchars($userData['phone']); ?>" required>
        </div>
        <button type="submit" class="btn-update">Update Profile</button>
    </form>
    


<?php include __DIR__ . '/../src/views/footer.php'; ?>
</body>
</html>