<?php 
// Set proper 404 response code
http_response_code(404);
$pageTitle = "Page Not Found";
include_once __DIR__ . '/../src/views/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="assets/css/404.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="error-content-404">
            <img src="assets/images/404-error.png" alt="404 Error" class="error-image-404">
            
            <h1 class="error-title-404">Oops! Page Not Found</h1>
            <p class="error-message-404">The page you're looking for doesn't exist or has been moved.</p>
            
            <div class="action-buttons-404">
                <a href="index.php" class="btn-404 btn-primary-404">
                    <i class="fas fa-home me-2"></i>Go Home
                </a>
                <a href="#contact-us" class="btn-404 btn-outline-secondary-404">
                    <i class="fas fa-envelope me-2"></i>Contact Support
                </a>
            </div>
            
            <div class="error-details-404">
                <p>Error Code: 404 - Not Found</p>
                <?php if (isset($_SERVER['HTTP_REFERER'])): ?>
                    <p class="mt-2">
                        <a href="<?= htmlspecialchars($_SERVER['HTTP_REFERER']) ?>" class="back-link-404">
                            <i class="fas fa-arrow-left me-1"></i>Return to previous page
                        </a>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>

<?php 
include_once __DIR__ . '/../src/views/footer.php';
?>
