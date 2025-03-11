
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
                <input type="text" name="source" placeholder="From City" 
                       value="<?= htmlspecialchars($_GET['source'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <input type="text" name="destination" placeholder="To City" 
                       value="<?= htmlspecialchars($_GET['destination'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <input type="date" name="date" 
                       value="<?= htmlspecialchars($_GET['date'] ?? date('Y-m-d')) ?>" 
                       min="<?= date('Y-m-d') ?>" required>
            </div>
            <button type="submit" class="btn-search">Search Buses</button>
        </form>
    </div>

    <div class="bus-listings">
        <?php if ($error): ?>
            <p class="error"><?= $error ?></p>
        <?php elseif (!empty($buses)): ?>
            <?php foreach ($buses as $bus): ?>
                <div class="bus-card">
                    <div class="bus-info">
                        <h3><?= htmlspecialchars($bus['bus_name']) ?></h3>
                        <div class="route">
                            <span class="source"><?= htmlspecialchars($bus['source']) ?></span>
                            <span class="arrow">➔</span>
                            <span class="destination"><?= htmlspecialchars($bus['destination']) ?></span>
                        </div>
                        <div class="timing">
                            <span><?= date('h:i A', strtotime($bus['departure_time'])) ?></span> - 
                            <span><?= date('h:i A', strtotime($bus['arrival_time'])) ?></span>
                        </div>
                    </div>
                    <div class="bus-price">
                        <div class="price">৳<?= $bus['price'] ?></div>
                        <a href="book.php?schedule_id=<?= $bus['schedule_id'] ?>" class="btn-book">Book Now</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php include __DIR__ . '/../src/views/footer.php'; ?>

    <script src="assets/js/script.js"></script>
    <script>
        // Set minimum date for date picker
        document.querySelector('input[type="date"]').min = new Date().toISOString().split('T')[0];
    </script>
</body>
</html>