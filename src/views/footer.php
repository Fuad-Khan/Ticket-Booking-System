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
  
 
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body and general styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    line-height: 1.6;
}

/* About Us Section */
#about-us {
    padding: 40px;
    background-color: #fff;
    text-align: center;
}

#about-us h2 {
    font-size: 2rem;
    color: #333;
    margin-bottom: 15px;
}

#about-us p {
    font-size: 1rem;
    color: #555;
    max-width: 800px;
    margin: 0 auto;
}

/* Contact Section */
#contact {
    padding: 40px;
    background-color: #f9f9f9;
    text-align: center;
    color: #333; /* Ensure the text is visible */
}

#contact h2 {
    font-size: 2rem;
    color: #333;
    margin-bottom: 15px;
}

#contact p {
    font-size: 1rem;
    color: #555;
}

#contact a {
    color: #007bff; /* Link color */
    text-decoration: none;
}

#contact a:hover {
    text-decoration: underline;
}


/* Footer */
footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 20px;
}

footer p {
    font-size: 1rem;
    margin-bottom: 10px;
}

footer .social-media {
    margin-top: 10px;
}

footer .social-media a {
    font-size: 1.5rem;
    margin: 0 10px;
    color: #fff;
    text-decoration: none;
}

footer .social-media a:hover {
    color: #4CAF50;
}

/* Responsive Design */
@media (max-width: 768px) {
    #about-us h2, #contact h2 {
        font-size: 1.5rem;
    }

    #about-us p, #contact p {
        font-size: 0.9rem;
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