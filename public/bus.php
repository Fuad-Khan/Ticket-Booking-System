<?php

session_start();
// Before redirecting to login page
$_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];

require_once __DIR__ . '/../src/controllers/BusController.php';
require_once __DIR__ . '/../src/controllers/BookingController.php';

// Initialize controllers
$busController = new BusController();
$bookingController = new BookingController();

// Initialize variables
$source = $_GET['source'] ?? ($_POST['source'] ?? '');
$destination = $_GET['destination'] ?? ($_POST['destination'] ?? '');
$travel_date = $_GET['travel_date'] ?? ($_POST['travel_date'] ?? date('Y-m-d'));
$buses = [];
$selected_seats_count = 0;
$max_seats = 4; // Maximum seats that can be selected

// Handle search form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
    $source = $_POST['source'];
    $destination = $_POST['destination'];
    $travel_date = $_POST['travel_date'];
    $buses = $busController->searchBuses($source, $destination, $travel_date);
}

// Handle booking form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book'])) {
    // Store selected seats in session before checking login
    $_SESSION['selected_seats'] = $_POST['seats'] ?? [];
    $_SESSION['schedule_id'] = $_POST['schedule_id'];
    $_SESSION['source'] = $_POST['source'];
    $_SESSION['destination'] = $_POST['destination'];
    $_SESSION['travel_date'] = $_POST['travel_date'];

    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        // Store current URL for redirect after login
        $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
        header("Location: login.php");
        exit();
    } else {
        // User is logged in, proceed to booking confirmation
        header("Location: booking_confirm.php");
        exit();
    }
}

// Get available seats for a schedule
$available_seats = [];
if (isset($_GET['schedule_id'])) {
    $available_seats = $bookingController->getAvailableSeats($_GET['schedule_id'], $travel_date);
    $schedule = (new Schedule())->getScheduleById($_GET['schedule_id']);
    $bus = (new Bus())->getBusById($schedule['bus_id']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Booking</title>
    <link rel="stylesheet" href="assets/css/bus.css">
</head>

<body class="bus-booking-page">
    <?php include __DIR__ . '/../src/views/header.php'; ?>

    <div class="bus-container">
        <h1 class="bus-header">Bus Ticket Booking</h1>

        <!-- Search Form -->
        <form method="POST" class="bus-search-form">
            <div class="bus-form-group">
                <label for="source">From:</label>
                <input type="text" id="source" name="source" class="bus-input" value="<?= htmlspecialchars($source) ?>" required>
            </div>
            <div class="bus-form-group">
                <label for="destination">To:</label>
                <input type="text" id="destination" name="destination" class="bus-input" value="<?= htmlspecialchars($destination) ?>" required>
            </div>
            <div class="bus-form-group">
                <label for="travel_date">Travel Date:</label>
                <input type="date" id="travel_date" name="travel_date" class="bus-input" 
                       value="<?= htmlspecialchars($travel_date) ?>" 
                       min="<?= date('Y-m-d') ?>" required>
            </div>
            <button type="submit" name="search" class="bus-primary-btn">Search Buses</button>
        </form>

        <!-- Search Results -->
        <?php if (!empty($buses)): ?>
            <h2 class="bus-subheader">Available Buses for <?= date('F j, Y', strtotime($travel_date)) ?></h2>
            <div class="bus-list">
                <?php foreach ($buses as $bus): ?>
                    <div class="bus-card">
                        <h3 class="bus-card-title"><?= htmlspecialchars($bus['bus']['bus_name']) ?></h3>
                        <p class="bus-card-text">Route: <?= htmlspecialchars($bus['route']['source']) ?> to <?= htmlspecialchars($bus['route']['destination']) ?></p>
                        <p class="bus-card-text">Departure: <?= date('h:i A', strtotime($bus['schedule']['departure_time'])) ?></p>
                        <p class="bus-card-text">Arrival: <?= date('h:i A', strtotime($bus['schedule']['arrival_time'])) ?></p>
                        <p class="bus-card-text">Date: <?= date('F j, Y', strtotime($travel_date)) ?></p>
                        <p class="bus-card-text">Price: <?= number_format($bus['schedule']['price'], 2) ?> Taka</p>
                        <a href="bus.php?schedule_id=<?= $bus['schedule']['schedule_id'] ?>&source=<?= urlencode($source) ?>&destination=<?= urlencode($destination) ?>&travel_date=<?= urlencode($travel_date) ?>" class="bus-card-link">View Seats</a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Seat Selection -->
        <?php if (!empty($available_seats) && isset($schedule)): ?>
            <div class="bus-departure-info">
                <h2 class="bus-departure-header">DEPARTURE - <?= date('F j, Y', strtotime($travel_date)) ?></h2>
                <h3 class="bus-departure-title"><?= htmlspecialchars($bus['bus_name']) ?> - <?= date('h:i A', strtotime($schedule['departure_time'])) ?></h3>
                <p class="bus-departure-note"><em>Trip time may delay due to traffic</em></p>
            </div>

            <h3 class="bus-seats-limit">Maximum <?= $max_seats ?> seats can be selected.</h3>

            <div class="bus-seat-legend">
                <div class="bus-legend-item">
                    <div class="bus-legend-box bus-available-box"></div>
                    <span>Available</span>
                </div>
                <div class="bus-legend-item">
                    <div class="bus-legend-box bus-sold-box"></div>
                    <span>Sold</span>
                </div>
                <div class="bus-legend-item">
                    <div class="bus-legend-box bus-selected-box"></div>
                    <span>Selected</span>
                </div>
            </div>

            <form method="POST" id="bus-booking-form">
                <input type="hidden" name="schedule_id" value="<?= $_GET['schedule_id'] ?>">
                <input type="hidden" name="source" value="<?= htmlspecialchars($source) ?>">
                <input type="hidden" name="destination" value="<?= htmlspecialchars($destination) ?>">
                <input type="hidden" name="travel_date" value="<?= htmlspecialchars($travel_date) ?>">

                <div class="bus-seat-map">
                    <?php
                    $seats_per_row = 4;
                    $seat_numbers = array_keys($available_seats);
                    $total_seats = count($seat_numbers);

                    for ($i = 0; $i < $total_seats; $i += $seats_per_row):
                        $row_seats = array_slice($seat_numbers, $i, $seats_per_row);
                    ?>
                        <div class="bus-seat-row">
                            <?php foreach ($row_seats as $index => $seat_number):
                                $is_available = $available_seats[$seat_number];
                                // Add gap after 2nd seat
                                if ($index == 2) echo '<div class="bus-seat-gap"></div>';
                            ?>
                                <div class="bus-seat <?= $is_available ? 'bus-available' : 'bus-booked' ?>">
                                    <input type="checkbox" id="seat-<?= $seat_number ?>"
                                        name="seats[]" value="<?= $seat_number ?>"
                                        <?= !$is_available ? 'disabled' : '' ?>
                                        data-seat="<?= $seat_number ?>">
                                    <label for="seat-<?= $seat_number ?>"><?= $seat_number ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endfor; ?>
                </div>
                <div class="bus-selected-count">
                    <span id="bus-selected-count">0</span> ticket(s) selected
                </div>

                <button type="submit" name="book" class="bus-continue-btn" disabled>CONTINUE</button>
            </form>
        <?php endif; ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.bus-seat input[type="checkbox"]');
            const continueBtn = document.querySelector('.bus-continue-btn');
            const selectedCount = document.getElementById('bus-selected-count');
            const maxSeats = <?= $max_seats ?>;

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const seatDiv = this.closest('.bus-seat');

                    if (this.checked) {
                        seatDiv.classList.add('bus-selected');
                        seatDiv.classList.remove('bus-available');
                    } else {
                        seatDiv.classList.remove('bus-selected');
                        if (seatDiv.classList.contains('bus-available')) {
                            seatDiv.classList.add('bus-available');
                        }
                    }

                    // Count selected seats
                    const selectedSeats = document.querySelectorAll('.bus-seat input[type="checkbox"]:checked');
                    const selectedCountValue = selectedSeats.length;

                    selectedCount.textContent = selectedCountValue;

                    // Enable/disable continue button
                    continueBtn.disabled = selectedCountValue === 0;

                    // Disable additional selections if max reached
                    if (selectedCountValue >= maxSeats) {
                        document.querySelectorAll('.bus-seat.bus-available').forEach(seat => {
                            const cb = seat.querySelector('input[type="checkbox"]');
                            if (!cb.checked) {
                                cb.disabled = true;
                                seat.classList.add('bus-max-reached');
                            }
                        });
                    } else {
                        document.querySelectorAll('.bus-seat.bus-max-reached').forEach(seat => {
                            const cb = seat.querySelector('input[type="checkbox"]');
                            cb.disabled = false;
                            seat.classList.remove('bus-max-reached');
                        });
                    }
                });
            });

            // Initialize selected seats count
            const initialSelected = document.querySelectorAll('.bus-seat input[type="checkbox"]:checked').length;
            selectedCount.textContent = initialSelected;
            continueBtn.disabled = initialSelected === 0;
        });
    </script>

    <?php include __DIR__ . '/../src/views/footer.php'; ?>
</body>

</html>