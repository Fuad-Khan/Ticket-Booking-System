<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Ticket Booking</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bus.css">
</head>
<body>
<?php include __DIR__ . '/../src/views/header.php'; ?>

    

    <main>
        <!-- Transport Options -->
        <section class="transport-options">
            <button class="active">BUS</button>
            
        </section>

        <!-- Search Form -->
        <section class="search-form">
            <div class="form-group">
                <label for="going-from">GOING FROM</label>
                <input type="text" id="going-from" >
            </div>
            <div class="form-group">
                <label for="going-to">GOING TO</label>
                <input type="text" id="going-to" >
            </div>
            <div class="form-group">
                <label for="journey-date">JOURNEY DATE</label>
                <input type="date" id="journey-date">
            </div>
            <div class="form-group">
                <label for="return-date">RETURN DATE</label>
                <input type="date" id="return-date">
            </div>
            <button class="search-button">Search Bus</button>
        </section>

       
    </main>
    <?php include __DIR__ . '/../src/views/footer.php'; ?>


    <script src="assets/js/bus.js"></script>
</body>
</html>