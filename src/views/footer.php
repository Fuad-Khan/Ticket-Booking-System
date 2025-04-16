<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Your Ticket - Online Bus Booking</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* Body and Page Structure - Minimal impact solution */
        body {
            position: relative;
            min-height: 100vh;
            margin: 0;
            padding-bottom: 300px; /* Adjust based on footer height */
            box-sizing: border-box;
        }
        
     

        /* Scoped Footer Styles */
        .ticket-footer {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #2575fc, #1a55b4);
            color: #fff;
            padding: 2rem 5%;
            position: absolute;
            bottom: 0;
            width: 100%;
            box-sizing: border-box;
        }

        .ticket-footer .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .ticket-footer .footer-section h3 {
            color: #ffcc00;
            font-size: 1.4rem;
            margin-bottom: 1rem;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .ticket-footer .footer-section h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: #ffcc00;
        }

        .ticket-footer .footer-section p {
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 0.8rem;
        }

        .ticket-footer .footer-section a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s ease;
            display: block;
            margin-bottom: 0.6rem;
        }

        .ticket-footer .footer-section a:hover {
            color: #ffcc00;
        }

        .ticket-footer .social-media {
            display: flex;
            gap: 1.2rem;
            margin-top: 1rem;
        }

        .ticket-footer .social-media a {
            font-size: 1.4rem;
            color: #fff;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .ticket-footer .social-media a:hover {
            transform: translateY(-3px);
            color: #ffcc00;
        }

        .ticket-footer .footer-bottom {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.9rem;
        }

        .ticket-footer .footer-bottom p {
            margin: 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding-bottom: 400px; /* Adjust for mobile footer height */
            }
            
            .ticket-footer .footer-container {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 1rem;
            }

            .ticket-footer .footer-section h3::after {
                left: 50%;
                transform: translateX(-50%);
            }

            .ticket-footer .social-media {
                justify-content: center;
            }
        }
    </style>
</head>

<body>


    <!-- Footer -->
    <footer class="ticket-footer">
        <div class="footer-container">
            <!-- About Section -->
            <div class="footer-section" id="about-us">
                <h3>About Us</h3>
                <p>Take Your Ticket is your trusted partner for online ticket bookings. We provide seamless and secure booking experiences for travelers across Bangladesh.</p>
            </div>

            <!-- Contact Info -->
            <div class="footer-section" id="contact-us">
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
            <p>&copy; 2025 Take Your Ticket. All rights reserved. | Developed by Team Take it Easy</p>
        </div>
    </footer>

</body>

</html>