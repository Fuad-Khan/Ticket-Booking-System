<?php 
// Set proper 500 response code
http_response_code(500);
$pageTitle = "Server Error";
include_once __DIR__ . '/../src/views/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="assets/css/500.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<div class="container">
    <div class="error-content">
        <img src="assets/images/500-error.png" alt="500 Error" class="error-image">
        
        <h1 class="error-title">Server Error</h1>
        <p class="error-message">We're experiencing technical difficulties. Our team has been notified.</p>
        
        <div class="error-help">
            <h5 class="error-help-title"><i class="fas fa-exclamation-circle"></i> What to do now?</h5>
            <ul class="error-help-list">
                <li>Try refreshing the page</li>
                <li>Check back in a few minutes</li>
                <li>If the problem persists, contact our support team</li>
            </ul>
        </div>
        
        <div class="action-buttons">
            <a href="index.php" class="btn btn-primary">
                <i class="fas fa-home me-2"></i>Return Home
            </a>
            <a href="#contact-us" class="btn btn-outline-danger">
                <i class="fas fa-headset me-2"></i>Emergency Support
            </a>
        </div>
        
        <div class="error-details">
            <p>Error Code: 500 - Internal Server Error</p>
            <?php if (isset($_SERVER['REQUEST_URI'])): ?>
                <div class="error-url">
                    Failed URL: <?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>

<?php 
include_once __DIR__ . '/../src/views/footer.php';
?>
