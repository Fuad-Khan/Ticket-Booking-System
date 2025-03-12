<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Your Ticket</title>
    <!-- Font Awesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
        }

        /* Header */
        header {
            background: linear-gradient(to right, #2575fc, #1a55b4);
            color: white;
            padding: 20px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            flex-wrap: wrap;
            width: 100%;
            transition: all 0.3s ease;
        }

        /* Logo */
        .logo h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 0;
            transition: transform 0.3s ease;
        }

        .logo h1 a {
            text-decoration: none;
            color: white;
        }

        .logo h1:hover {
            transform: scale(1.1);
        }

        /* Navigation */
        nav {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        nav a:hover {
            background-color: rgba(255, 255, 255, 0.4);
            transform: scale(1.05);
        }

        nav a:focus {
            outline: 2px solid #fff;
            outline-offset: 3px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                padding: 15px 5%;
                gap: 15px;
            }

            .logo h1 {
                font-size: 2rem;
            }

            nav {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            nav {
                flex-direction: column;
                width: 100%;
                align-items: center;
                gap: 10px;
            }

            nav a {
                width: 100%;
                padding: 12px;
            }
        }
    </style>
</head>
<body>
<!-- Header Section -->
<header>
    <div class="logo">
        <h1><a href="index.php">Take Your Ticket</a></h1>
    </div>

    <nav>
        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Logged-in User Links -->
            <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
            <a href="#about-us"><i class="fas fa-info-circle"></i> About Us</a>
            <a href="#contact"><i class="fas fa-envelope"></i> Contact</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        <?php else: ?>
            <!-- Guest User Links -->
            <a href="#about-us"><i class="fas fa-info-circle"></i> About Us</a>
            <a href="#contact"><i class="fas fa-envelope"></i> Contact</a>
            <a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
            <a href="register.php"><i class="fas fa-user-plus"></i> Register</a>
        <?php endif; ?>
    </nav>
</header>
</body>
</html>