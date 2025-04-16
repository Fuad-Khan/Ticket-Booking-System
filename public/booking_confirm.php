<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    header("Location: login.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate required fields
    $required = ['first_name', 'last_name', 'mobile_number', 'gender', 'schedule_id', 'seats'];
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            $_SESSION['error'] = "Missing required field: $field";
            header("Location: booking_confirm.php");
            exit();
        }
    }

    require_once __DIR__ . '/../src/model/Schedule.php';
    require_once __DIR__ . '/../src/model/Bus.php';
    require_once __DIR__ . '/../src/model/Booking.php';

    try {
        // Get schedule and bus details
        $scheduleModel = new Schedule();
        $busModel = new Bus();
        $bookingModel = new Booking();
        
        $schedule = $scheduleModel->getScheduleById($_POST['schedule_id']);
        $bus = $busModel->getBusById($schedule['bus_id']);

        // Create booking
        $seatNumbers = explode(',', $_POST['seats']);
        $totalPrice = $schedule['price'] * count($seatNumbers);
        
        $bookingId = $bookingModel->createBooking(
            $_SESSION['user_id'],
            $_POST['schedule_id'],
            $_POST['seats'],
            $totalPrice,
            'confirmed',
            $_POST['first_name'] . ' ' . $_POST['last_name'],
            $_POST['mobile_number'],
            $_POST['gender']
        );

        // Set booking data for success page
        $_SESSION['booking_data'] = [
            'booking_id' => $bookingId,
            'passenger' => [
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'mobile' => $_POST['mobile_number'],
                'gender' => $_POST['gender']
            ],
            'bus' => $bus,
            'schedule' => $schedule,
            'seats' => $seatNumbers,
            'total_price' => $totalPrice
        ];

        header("Location: booking_success.php");
        exit();

    } catch (Exception $e) {
        $_SESSION['error'] = "Booking failed: " . $e->getMessage();
        header("Location: booking_confirm.php");
        exit();
    }
}

// Get booking data from session for display
if (!isset($_SESSION['selected_seats']) || !isset($_SESSION['schedule_id'])) {
    $_SESSION['error'] = 'Invalid booking session. Please start over.';
    header("Location: bus.php");
    exit();
}

$selected_seats = $_SESSION['selected_seats'];
$schedule_id = $_SESSION['schedule_id'];
$source = $_SESSION['source'];
$destination = $_SESSION['destination'];

// Get schedule and bus details for display
require_once __DIR__ . '/../src/model/Schedule.php';
require_once __DIR__ . '/../src/model/Bus.php';

$scheduleModel = new Schedule();
$busModel = new Bus();

$schedule = $scheduleModel->getScheduleById($schedule_id);
$bus = $busModel->getBusById($schedule['bus_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Booking</title>
    <link rel="stylesheet" href="assets/css/booking_confirm.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../src/views/header.php'; ?>

    <div class="booking-container">
        <div class="booking-summary">
            <h2>Booking Summary</h2>
            <div class="summary-item">
                <span>Bus:</span>
                <span><?= htmlspecialchars($bus['bus_name']) ?></span>
            </div>
            <div class="summary-item">
                <span>Route:</span>
                <span><?= htmlspecialchars($source) ?> to <?= htmlspecialchars($destination) ?></span>
            </div>
            <div class="summary-item">
                <span>Departure:</span>
                <span><?= date('M d, Y h:i A', strtotime($schedule['departure_time'])) ?></span>
            </div>
            <div class="summary-item">
                <span>Selected Seats:</span>
                <span><?= implode(', ', $selected_seats) ?></span>
            </div>
            <div class="summary-item">
                <span>Total Price:</span>
                <span><?= number_format(count($selected_seats) * $schedule['price'], 2) ?> Taka</span>
            </div>
        </div>

        <div class="booking-card">
            <h1>Passenger Information</h1>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
            <form ac method="POST" id="bookingForm">
                <!-- Hidden fields to pass booking data -->
                <input type="hidden" name="schedule_id" value="<?= $schedule_id ?>">
                <input type="hidden" name="seats" value="<?= htmlspecialchars(implode(',', $selected_seats)) ?>">
                <input type="hidden" name="source" value="<?= htmlspecialchars($source) ?>">
                <input type="hidden" name="destination" value="<?= htmlspecialchars($destination) ?>">

                <div class="form-group">
                    <label for="booking_for">Booking For</label>
                    <div class="radio-group">
                        <label>
                            <input type="radio" name="booking_for" value="self" checked> Self
                        </label>
                        <label>
                            <input type="radio" name="booking_for" value="others"> Others
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="mobile_number">Mobile Number*</label>
                    <input type="text" id="mobile_number" name="mobile_number" placeholder="Enter your Number" required
                           value="<?= isset($_POST['mobile_number']) ? htmlspecialchars($_POST['mobile_number']) : '' ?>">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email"
                           value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
                </div>

                <div class="form-group">
                    <label for="first_name">First Name*</label>
                    <input type="text" id="first_name" name="first_name" placeholder="Enter your first name" required
                           value="<?= isset($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : '' ?>">
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name*</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Enter your last name" required
                           value="<?= isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : '' ?>">
                </div>

                <div class="form-group">
                    <label for="gender">Gender*</label>
                    <div class="radio-group">
                        <label>
                            <input type="radio" name="gender" value="male" required 
                                <?= (isset($_POST['gender']) && $_POST['gender'] === 'male') ? 'checked' : '' ?>> Male
                        </label>
                        <label>
                            <input type="radio" name="gender" value="female"
                                <?= (isset($_POST['gender']) && $_POST['gender'] === 'female') ? 'checked' : '' ?>> Female
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Proceed to Payment</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            // Simple client-side validation
            const requiredFields = [
                'mobile_number', 'first_name', 'last_name'
            ];
            
            let isValid = true;
            
            requiredFields.forEach(field => {
                const element = document.getElementById(field);
                if (!element.value.trim()) {
                    element.style.border = '1px solid red';
                    isValid = false;
                } else {
                    element.style.border = '';
                }
            });
            
            const genderSelected = document.querySelector('input[name="gender"]:checked');
            if (!genderSelected) {
                alert('Please select your gender');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
                alert('Please fill all required fields');
            }
        });
    </script>

    <?php include __DIR__ . '/../src/views/footer.php'; ?>
</body>
</html>