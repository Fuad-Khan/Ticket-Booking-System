

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Booking</title>
    <link rel="stylesheet" href="assets/css/booking_confirm.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php include __DIR__ . '/../src/views/header.php'; ?>

    <div class="booking-container">
        <div class="booking-card">
            <h1>Passenger Information</h1>
            <form action="payment.php" method="POST">
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
                    <input type="text" id="mobile_number" name="mobile_number" placeholder="Enter your Number" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email">
                </div>

                <div class="form-group">
                    <label for="first_name">First Name*</label>
                    <input type="text" id="first_name" name="first_name" placeholder="Enter your first name" required>
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name*</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Enter your last name" required>
                </div>

                <div class="form-group">
                    <label for="gender">Gender*</label>
                    <div class="radio-group">
                        <label>
                            <input type="radio" name="gender" value="male" required> Male
                        </label>
                        <label>
                            <input type="radio" name="gender" value="female"> Female
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Proceed
                </button>
            </form>
        </div>
    </div>
        <?php include __DIR__ . '/../src/views/footer_sub.php'; ?>

</body>
</html>