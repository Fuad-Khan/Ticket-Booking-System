<?php
session_start();
require_once __DIR__ . '/../src/config/database.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Tickets - Take Your Ticket</title>
    <link rel="stylesheet" href="assets/css/bus.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include __DIR__ . '/../src/views/header.php'; ?>

    <div class="hero">
        <h1>Bus Tickets</h1>
        <p>Book your bus tickets online.</p>
    </div>

    <div class="search-form">
        <form action="bus.php" method="GET">
            <div class="form-group">
                <input type="text" name="source" placeholder="From City" required>
            </div>
            <div class="form-group">
                <input type="text" name="destination" placeholder="To City" required>
            </div>
            <div class="form-group">
                <input type="date" name="date" min="<?= date('Y-m-d') ?>" required>
            </div>
            <button type="submit" class="btn-search">Search Buses</button>
        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['source'])) {
        // Fetch and display bus results (same as previous index.php logic)
    }
    ?>

    <?php include __DIR__ . '/../src/views/footer.php'; ?>

    <script src="assets/js/script.js"></script>
</body>
</html>