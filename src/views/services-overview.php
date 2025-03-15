<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Booking - Easy and Convenient</title>
    <style>
        /* Unique container class */
        .ticket-container {
            --ticket-primary: #2c3e50;
            --ticket-accent: #2980b9;
            --ticket-text: #34495e;
            --ticket-border: #ecf0f1;
            font-family: 'Helvetica Neue', Arial, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .ticket-container * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .ticket-main-title {
            font-size: 2rem;
            color: var(--ticket-primary);
            text-align: center;
            margin: 2rem 0;
            font-weight: 600;
        }

        .ticket-steps {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin: 2rem 0;
            padding: 1.5rem 0;
        }

        .ticket-step {
            padding: 1.5rem;
            background: #f8f9fa;
            border-radius: 8px;
            text-align: center;
        }

        .ticket-step-title {
            color: var(--ticket-accent);
            font-size: 1.3rem;
            margin: 1rem 0;
        }

        .ticket-divider {
            border: 0;
            height: 1px;
            background: var(--ticket-border);
            margin: 2rem 0;
        }

        .ticket-services {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .ticket-service {
            padding: 1.5rem;
            border: 1px solid var(--ticket-border);
            border-radius: 8px;
        }

        .ticket-service-title {
            color: var(--ticket-primary);
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }

        .ticket-highlight {
            text-align: center;
            padding: 2rem;
            margin: 2rem 0;
            background: #f8f9fa;
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            .ticket-steps {
                grid-template-columns: 1fr;
            }
            
            .ticket-main-title {
                font-size: 1.75rem;
            }
        }
    </style>
</head>
<body>
    <!-- Wrapped in unique container class -->
    <div class="ticket-container">
        <h1 class="ticket-main-title">Book Tickets with Ease</h1>

        <div class="ticket-steps">
            <div class="ticket-step">
                <h2 class="ticket-step-title">Search</h2>
                <p>Pick your category, location, date, and browse available options</p>
            </div>
            <div class="ticket-step">
                <h2 class="ticket-step-title">Choose</h2>
                <p>Pick your preferred seat and ticket type, then proceed to checkout</p>
            </div>
            <div class="ticket-step">
                <h2 class="ticket-step-title">Pay</h2>
                <p>Make payment via your preferred method – card, mobile, or other</p>
            </div>
        </div>

        <hr class="ticket-divider">

        <div class="ticket-highlight">
            <h2>Your One-Stop Ticketing Platform</h2>
            <p><strong>Easy access to tickets for all your travel, entertainment, and event needs</strong></p>
        </div>

        <div class="ticket-services">
            <div class="ticket-service">
                <h3 class="ticket-service-title">Bus Tickets</h3>
                <p>Book tickets for buses from a wide range of operators, all available at your fingertips.</p>
            </div>

            <div class="ticket-service">
                <h3 class="ticket-service-title">Train Tickets</h3>
                <p>Skip the line and book your train tickets to travel across the country with ease.</p>
            </div>

            <div class="ticket-service">
                <h3 class="ticket-service-title">Flight Tickets</h3>
                <p>Fly anywhere within Bangladesh with affordable air tickets, easily booked online.</p>
            </div>

            <div class="ticket-service">
                <h3 class="ticket-service-title">Movie Tickets</h3>
                <p>Don't miss the latest blockbusters! Book your movie tickets in advance for a hassle-free experience.</p>
            </div>

            <div class="ticket-service">
                <h3 class="ticket-service-title">Event Tickets</h3>
                <p>From concerts to conferences, get your tickets to exciting events across the country.</p>
            </div>
        </div>
    </div>
</body>
</html>