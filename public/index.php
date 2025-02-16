<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Your Ticket - Home</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    
    <div class="hero">
        <h1>Welcome to Take Your Ticket</h1>
        <p>Your one-stop solution for booking tickets online.</p>
    </div>
    
    <div class="services">
        <div class="service-card active" onclick="window.location.href='bus.php'">
            <div class="icon">🚌</div>
            <h3>Bus Tickets</h3>
            <p>Book bus tickets for your next trip.</p>
        </div>

        <div class="service-card disabled">
            <div class="icon">🚆</div>
            <h3>Train Tickets</h3>
            <p>Service not available right now.</p>
        </div>

        <div class="service-card disabled">
            <div class="icon">✈️</div>
            <h3>Flight Tickets</h3>
            <p>Service not available right now.</p>
        </div>

        <div class="service-card disabled">
            <div class="icon">🎬</div>
            <h3>Movie Tickets</h3>
            <p>Service not available right now.</p>
        </div>

        <div class="service-card disabled">
            <div class="icon">🎟️</div>
            <h3>Event Tickets</h3>
            <p>Service not available right now.</p>
        </div>
    </div>
</body>
</html>
