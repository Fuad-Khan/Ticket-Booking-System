<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Online Shop</title>
    <!-- Font Awesome CDN for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/../public/assets/css/footer.css">

    <style>
        /* Basic Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body Style */
body {
    font-family: 'Roboto', Arial, sans-serif;
    line-height: 1.6;
    background-color: #f4f6f9; /* Light gray background */
    color: #333;
  
}

/* About Us Section */
#about-us {
    background-color: #ffffff;
    padding: 40px;
    margin-bottom: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Soft shadow for depth */
    transition: transform 0.3s ease;
}

#about-us:hover {
    transform: translateY(-10px); /* Lift effect on hover */
}

#about-us h2 {
    font-size: 2em;
    color: #2c3e50;
    margin-bottom: 20px;
}

#about-us p {
    font-size: 1.2em;
    color: #7f8c8d;
    line-height: 1.8;
}

/* Contact Section */
#contact {
    background-color: #ffffff;
    padding: 40px;
    margin-bottom: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

#contact h2 {
    font-size: 2em;
    color: #2c3e50;
    margin-bottom: 20px;
}

#contact p {
    font-size: 1.2em;
    color: #7f8c8d;
    line-height: 1.8;
}

#contact a {
    color: #3498db;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease, transform 0.2s ease;
}

#contact a:hover {
    color: #190588;
    text-decoration: underline;
    transform: scale(1.05); /* Slight scaling effect */
}

/* Footer */
footer {
    background-color: #2c3e50;
    color: #fff;
    text-align: center;
    padding: 30px;
    position: relative;
    width: 100%;
    bottom: 0;
    box-shadow: 0 -4px 6px rgba(0, 0, 0, 0.1);
}

footer p {
    margin: 10px 0;
}

/* Social Media Links */
.social-media {
    margin: 20px 0;
}

.social-media a {
    color: #fff;
    margin: 0 15px;
    text-decoration: none;
    font-size: 2em;
    transition: color 0.3s ease-in-out, transform 0.3s ease;
}

.social-media a:hover {
    transform: scale(1.1); /* Slight enlarge on hover */
}

/* Social Media Specific Colors */
.social-media a:nth-child(1):hover {
    color: #b906f0;  /* Instagram Pink */
}

.social-media a:nth-child(2):hover {
    color: #3b5998; /* Facebook Blue */
}

.social-media a:nth-child(3):hover {
    color: #010000; 
}

.social-media a:nth-child(4):hover {
    color: #ff0000;  /* YouTube Red */
}

.social-media a:nth-child(5):hover {
    color: #0496ff; /* Twitter Blue */
}

/* Media Queries for Responsiveness */
@media (max-width: 768px) {
    #about-us, #contact {
        padding: 20px;
    }

    #about-us h2, #contact h2 {
        font-size: 1.8em;
    }

    #about-us p, #contact p {
        font-size: 1em;
    }

    .social-media a {
        font-size: 1.6em;
    }
}

@media (max-width: 480px) {
    body {
        padding-top: 20px;
    }

    #about-us, #contact {
        padding: 15px;
    }

    #about-us h2, #contact h2 {
        font-size: 1.6em;
    }

    #about-us p, #contact p {
        font-size: 0.9em;
    }

    footer p {
        font-size: 1em;
    }
}
    </style>
 
</head>
<body>

    <!-- About Us Section -->
    <section id="about-us">
        <h2>About Us</h2>
        <p>Welcome to MyOnlineShop. We provide a wide variety of products from different categories such as electronics, groceries, clothes, and more. Our goal is to offer great products at the best prices and deliver them with care.</p>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <h2>Contact Us</h2>
        <p>If you have any questions, feel free to contact us at <a href="mailto:fuadkhan183@gmail.com">fuadkhan183@gmail.com</a></p>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 My Shop. All rights reserved.</p>
        <div class="social-media">
            <p>Follow Us:</p>
            <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="https://github.com/Fuad-Khan" target="_blank"><i class="fab fa-github"></i></a>
            <a href="https://www.youtube.com" target="_blank"><i class="fab fa-youtube"></i></a>
            <a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
        </div>
    </footer>

</body>
</html>