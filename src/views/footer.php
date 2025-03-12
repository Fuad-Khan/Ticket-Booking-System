<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Your Ticket - Online Bus Booking</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* Reset and General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
            min-height: 100vh; /* Ensure body takes at least the full viewport height */
            display: flex;
            flex-direction: column; /* Make body a flex container */
        }

        /* Main Content */
        .main-content {
            flex: 1; /* Allow main content to grow and push footer to the bottom */
            padding: 2rem 5%; /* Add some padding to the main content */
        }

        /* Footer Styles */
        footer {
            background: linear-gradient(to right, #2575fc, #1a55b4);
            color: #fff;
            padding: 2rem 5%;
            font-family: 'Arial', sans-serif;
            margin-top: auto; /* Push footer to the bottom */
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .footer-section {
            margin-bottom: 1.5rem;
        }

        .footer-section h3 {
            color: #ffcc00;
            font-size: 1.4rem;
            margin-bottom: 1rem;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .footer-section h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: #ffcc00;
        }

        .footer-section p {
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 0.8rem;
        }

        .footer-section a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s ease;
            display: block;
            margin-bottom: 0.6rem;
        }

        .footer-section a:hover {
            color: #ffcc00;
        }

        .social-media {
            display: flex;
            gap: 1.2rem;
            margin-top: 1rem;
        }

        .social-media a {
            font-size: 1.4rem;
            color: #fff;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .social-media a:hover {
            transform: translateY(-3px);
            color: #ffcc00;
        }

        .footer-bottom {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.9rem;
        }

        .footer-bottom p {
            margin: 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .footer-container {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 1rem;
            }

            .footer-section h3::after {
                left: 50%;
                transform: translateX(-50%);
            }

            .social-media {
                justify-content: center;
            }
        }
    </style>
</head>
<body>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <!-- About Section -->
            <div class="footer-section">
                <h3>About Us</h3>
                <p>Take Your Ticket is your trusted partner for online bus ticket bookings. We provide seamless and secure booking experiences for travelers across Bangladesh.</p>
            </div>

            <!-- Contact Info -->
            <div class="footer-section">
                <h3>Contact Us</h3>
                <p><i class="fas fa-map-marker-alt"></i> Dhaka, Bangladesh</p>
                <p><i class="fas fa-envelope"></i> fuadkhan183@gmail.com</p>
                <p><i class="fas fa-phone"></i> +8801726121880</p>
            </div>

            <!-- Social Media -->
            <div class="footer-section">
                <h3>Follow Us</h3>
                <div class="social-media">
                    <a href="https://www.facebook.com" aria-label="Facebook" target="_blank" rel="noopener">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="https://github.com/Fuad-Khan" aria-label="GitHub" target="_blank" rel="noopener">
                        <i class="fab fa-github"></i>
                    </a>
                    <a href="https://www.youtube.com" aria-label="YouTube" target="_blank" rel="noopener">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="https://twitter.com" aria-label="Twitter" target="_blank" rel="noopener">
                        <i class="fab fa-twitter"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p>&copy; 2024 Take Your Ticket. All rights reserved. | Developed by Fuad Khan</p>
        </div>
    </footer>
</body>
</html>
