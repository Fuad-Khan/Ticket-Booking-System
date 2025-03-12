# Bus Ticket Booking System

## Project Title: Take Your Ticket

### Team Name: Take it Easy
**Team Members:**  
- **Md. Mubtasim Fuad Khan** (ID: 221-35-883)  
- **Md. Taofick Mahmoodur Rahaman** (ID: 221-35-847)  
- **Abdullah Al Jubyer** (ID: 221-35-860)  

---

## Overview
The **Bus Ticket Booking System** aims to provide users with an efficient, seamless, and secure platform to book bus tickets online. The system enables users to search for buses, apply filters, select seats, make payments, and receive real-time notifications. Future extensions will allow the booking of other services like movies, events, flights, and trains.

---

## Features
### 1. **User Authentication**
- Sign-up/Login via email and phone.
- Secure authentication and password recovery.

### 2. **Bus Ticket Booking**
- Search for available buses by route, date, and operator.
- View available seats and select preferred seating.

### 3. **Filters and Search**
- Filter buses by price, departure time, and seat availability.
- Auto-suggestions for frequently booked routes.

### 4. **Booking and Payment**
- Interactive seat selection.
- Secure payment integration.
- Generate and download e-tickets.

### 5. **Notifications**
- Booking confirmations and reminders.
- Real-time updates on schedule changes.

### 6. **Admin Panel (Optional)**
- Manage bus operators, schedules, and ticket inventory.
- View analytics for bookings and revenue.

---

## Tech Stack
- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP, MySQL
- **Tools:** GitHub (Version Control)

---

## Future Enhancements
- **Mobile App Integration** for Android & iOS.
- **AI-based route recommendations** for frequent travelers.
- **Loyalty and reward programs** for regular users.
- **Multi-language support** to cater to a wider audience.

---

## Project Structure
```plaintext
bus-ticket-booking/                  # Root Directory
├── public/                          # Publicly accessible files
│   ├── assets/                      # CSS, JS, Images
│   ├── index.php                    # Homepage
│   ├── bus.php                       # Bus ticket booking page
│   ├── login.php                     # User login page
│   ├── register.php                  # User registration page
│   ├── payment.php                   # Payment page
│   ├── bookings.php                  # Booking confirmation page
│   ├── dashboard.php                 # User dashboard
│   ├── profile.php                    # User profile page
│   ├── about.php                      # About Us page
│   ├── contact.php                    # Contact Us page
│
├── admin/                           # Admin panel (optional)
│   ├── dashboard.php                # Admin dashboard
│   ├── manage-buses.php             # Manage buses
│   ├── manage-schedules.php         # Manage schedules
│   ├── view-bookings.php            # View all bookings
│   └── view-users.php               # View all users
│
├── src/                             # PHP source code (backend logic)
│   ├── config/database.php         # Database connection
│   ├── controllers/                 # Business logic controllers
│   ├── models/                      # Database interactions
│   ├── utils/                       # Helper functions
│   └── views/                       # Reusable HTML components
│
├── database/                        # SQL files
│   └── bus_booking.sql              # Database schema
│
├── README.md                        # Setup instructions
└── .htaccess                         # Security rules
```

---

## How to Run This Project

### 1. **Prerequisites**
Ensure you have the following installed on your system:
- **XAMPP / WAMP / LAMP / MAMP** (For Apache, PHP, and MySQL)
- **Git** (To clone the repository, optional)
- **PHP** (Recommended latest version)
- **MySQL** (Database)

### 2. **Clone the Repository**
```bash
git clone https://github.com/Fuad-Khan/Ticket-Booking-System.git
cd bus-ticket-booking
```
> If you don’t have Git installed, download the ZIP from GitHub and extract it manually.

### 3. **Configure the Database**
#### **Step 1: Create a Database**
1. Open **phpMyAdmin** (http://localhost/phpmyadmin/).
2. Click on **New**, enter `bus_booking` as the database name, and click **Create**.

#### **Step 2: Import the SQL File**
1. Click on the **bus_booking** database.
2. Go to the **Import** tab.
3. Click **Choose File** and select `database/bus_booking.sql`.
4. Click **Go** to import the database schema.

### 4. **Configure the Environment**
Open `src/config/database.php` and update the database credentials:
```php
$host = 'localhost';
$dbname = 'bus_booking';
$username = 'root';  // Change if using a different username
$password = '';     // Change if your database has a password
```

### 5. **Start the Web Server**
#### **Option 1: Using XAMPP / WAMP**
1. Move the project folder to `htdocs/` (XAMPP) or `www/` (WAMP).
2. Start **Apache** and **MySQL**.
3. Open a browser and go to:
   ```
   http://localhost/bus-ticket-booking/public/
   ```

---

## Contact
For any queries, please reach out to:
- **Email:** khan35-883@diu.edu.bd

---

