<?php
require_once __DIR__ . '/../src/config/bootstrap.php';
require_once __DIR__ . '/../src/controllers/BusController.php';

// Start session and handle redirects
Session::start();
if (!Session::exists('user_id')) {
    Session::set('redirect_url', $_SERVER['REQUEST_URI']);
    $login_message = "Please log in before checkout.";
} else {
    $login_message = "";
}

// Initialize BusController
$busController = new BusController();

// Handle search form submission
$buses = [];
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['source']) && isset($_GET['destination'])) {
    $source = Helpers::sanitize($_GET['source']);
    $destination = Helpers::sanitize($_GET['destination']);
    $date = Helpers::sanitize($_GET['date'] ?? date('Y-m-d'));
    
    $result = $busController->searchBuses($source, $destination, $date);
    
    if ($result['success']) {
        $buses = $result['data'];
    } else {
        $error = $result['message'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Tickets - Take Your Ticket</title>
    <link rel="stylesheet" href="assets/css/bus.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include __DIR__ . '/../src/views/header.php'; ?>

    <!-- Login message for non-logged in users -->
    <?php if ($login_message): ?>
        <div class="login-message">
            <p class="message-text"><?= htmlspecialchars($login_message) ?></p>
            <a href="login.php" class="btn-login">Go to Login</a>
        </div>
    <?php endif; ?>

    <div class="hero">
        <h1>Bus Tickets</h1>
        <p>Find and book your perfect bus journey</p>
    </div>

    <!-- Search Form with Autocomplete Suggestions -->
    <div class="search-container">
        <form action="bus.php" method="GET" class="search-form">
            <div class="form-row">
                <div class="form-group">
                    <label for="source">From</label>
                    <input type="text" id="source" name="source" placeholder="City or Station" 
                           value="<?= htmlspecialchars($_GET['source'] ?? '') ?>" required
                           autocomplete="off">
                    <div class="suggestions" id="source-suggestions"></div>
                </div>
                <button type="button" class="swap-btn" id="swap-locations">
                    <i class="fas fa-exchange-alt"></i>
                </button>
                <div class="form-group">
                    <label for="destination">To</label>
                    <input type="text" id="destination" name="destination" placeholder="City or Station" 
                           value="<?= htmlspecialchars($_GET['destination'] ?? '') ?>" required
                           autocomplete="off">
                    <div class="suggestions" id="destination-suggestions"></div>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group date-group">
                    <label for="date">Journey Date</label>
                    <input type="date" id="date" name="date" 
                           value="<?= htmlspecialchars($_GET['date'] ?? date('Y-m-d')) ?>" 
                           min="<?= date('Y-m-d') ?>" required>
                    <i class="fas fa-calendar-alt"></i>
                </div>
                
                <div class="form-group passenger-group">
                    <label for="passengers">Passengers</label>
                    <select id="passengers" name="passengers">
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <option value="<?= $i ?>" <?= (isset($_GET['passengers']) && $_GET['passengers'] == $i) ? 'selected' : '' ?>>
                                <?= $i ?> <?= $i === 1 ? 'Passenger' : 'Passengers' ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
                
                <button type="submit" class="btn-search">
                    <i class="fas fa-search"></i> Search Buses
                </button>
            </div>
        </form>
    </div>

    <!-- Search Results Section -->
    <div class="results-container">
        <?php if ($error): ?>
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i>
                <p><?= htmlspecialchars($error) ?></p>
            </div>
        <?php elseif (!empty($buses)): ?>
            <div class="results-header">
                <h2>Available Buses</h2>
                <div class="sort-options">
                    <span>Sort by:</span>
                    <select id="sort-buses">
                        <option value="departure">Departure Time</option>
                        <option value="arrival">Arrival Time</option>
                        <option value="price_low">Price (Low to High)</option>
                        <option value="price_high">Price (High to Low)</option>
                    </select>
                </div>
            </div>
            
            <div class="bus-listings">
                <?php foreach ($buses as $bus): ?>
                    <div class="bus-card">
                        <div class="bus-main">
                            <div class="bus-info">
                                <h3><?= htmlspecialchars($bus['bus_name']) ?></h3>
                                <div class="bus-type">
                                    <span class="badge">AC</span>
                                    <span class="badge">WiFi</span>
                                    <span class="badge">TV</span>
                                </div>
                            </div>
                            
                            <div class="route-info">
                                <div class="timing">
                                    <div class="time">
                                        <strong><?= date('h:i A', strtotime($bus['departure_time'])) ?></strong>
                                        <span><?= htmlspecialchars($bus['source']) ?></span>
                                    </div>
                                    <div class="duration">
                                        <?= calculateDuration($bus['departure_time'], $bus['arrival_time']) ?>
                                    </div>
                                    <div class="time">
                                        <strong><?= date('h:i A', strtotime($bus['arrival_time'])) ?></strong>
                                        <span><?= htmlspecialchars($bus['destination']) ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bus-details">
                            <div class="seats-available">
                                <i class="fas fa-chair"></i>
                                <span><?= $bus['available_seats'] ?> seats available</span>
                            </div>
                            
                            <div class="price-section">
                                <div class="price">৳<?= number_format($bus['price'], 2) ?></div>
                                <span class="per-person">per person</span>
                                
                                <?php if (Session::exists('user_id')): ?>
                                    <a href="book.php?schedule_id=<?= $bus['schedule_id'] ?>" 
                                       class="btn-book">
                                        Book Now
                                    </a>
                                <?php else: ?>
                                    <button class="btn-book login-required" 
                                            onclick="showLoginAlert()">
                                        Book Now
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-results">
                <img src="assets/images/no-buses.svg" alt="No buses found">
                <h3>No buses available</h3>
                <p>Try adjusting your search criteria or check back later</p>
            </div>
        <?php endif; ?>
    </div>

    <?php include __DIR__ . '/../src/views/footer.php'; ?>

    <script src="assets/js/script.js"></script>
    <script>
        // Set minimum date for date picker
        document.getElementById('date').min = new Date().toISOString().split('T')[0];
        
        // Swap locations
        document.getElementById('swap-locations').addEventListener('click', function() {
            const source = document.getElementById('source');
            const destination = document.getElementById('destination');
            const temp = source.value;
            source.value = destination.value;
            destination.value = temp;
        });
        
        // Show login alert for non-logged in users
        function showLoginAlert() {
            alert('Please login to book tickets. You will be redirected to the login page.');
            window.location.href = 'login.php';
        }
        
        // Sort buses
        document.getElementById('sort-buses').addEventListener('change', function() {
            // Implement client-side sorting or reload page with sort parameter
            const sortBy = this.value;
            const url = new URL(window.location.href);
            url.searchParams.set('sort', sortBy);
            window.location.href = url.toString();
        });
        
        // Autocomplete for source and destination
        const sourceInput = document.getElementById('source');
        const destInput = document.getElementById('destination');
        
        // Implement autocomplete functionality here
        // You would typically fetch suggestions from your database via AJAX
    </script>
</body>
</html>

<?php
// Helper function to calculate duration between two times
function calculateDuration($departure, $arrival) {
    $departureTime = new DateTime($departure);
    $arrivalTime = new DateTime($arrival);
    $interval = $departureTime->diff($arrivalTime);
    
    $hours = $interval->h;
    $minutes = $interval->i;
    
    if ($hours > 0 && $minutes > 0) {
        return "{$hours}h {$minutes}m";
    } elseif ($hours > 0) {
        return "{$hours}h";
    } else {
        return "{$minutes}m";
    }
}
?>