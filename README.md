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
- **Backend:** PHP, MySQL, Laravel
- **Tools:** GitHub (Version Control), Figma (UI Design)


---

## Future Enhancements
- **Mobile App Integration** for Android & iOS.
- **AI-based route recommendations** for frequent travelers.
- **Loyalty and reward programs** for regular users.
- **Multi-language support** to cater to a wider audience.

---

## Contributors
- **Md. Mubtasim Fuad Khan**  
- **Md. Taofick Mahmoodur Rahaman**  
- **Abdullah Al Jubyer**  

---



## Contact
For any queries, please reach out to:
- Email:khan35-883@diu.edu.bd 

## Project Structure

```plaintext
bus-ticket-booking/                  # Root Directory
│
├── public/                          # Publicly accessible files (Apache/Nginx document root)
│   ├── assets/                      
│   │   ├── css/                    # CSS files
│   │   │   └── style.css           # Main stylesheet
│   │   ├── js/                     # JavaScript files
│   │   │   └── script.js           # Main JS file
│   │   └── images/                 # Images (logos, backgrounds, etc.)
│   ├── index.php                   # Homepage (service selection)
│   ├── bus.php                     # Bus ticket booking page
│   ├── train.php                   # Train ticket booking page
│   ├── flight.php                  # Flight ticket booking page
│   ├── movie.php                   # Movie ticket booking page
│   ├── event.php                   # Event ticket booking page
│   ├── login.php                   # User login page
│   ├── register.php                # User registration page
│   ├── forgot-password.php         # Password recovery page
│   ├── bookings.php                # Booking confirmation page
│   ├── payment.php                 # Payment page
│   ├── booking-success.php         # Booking success page
│   ├── booking-failed.php          # Booking failed page
│   ├── dashboard.php               # User dashboard
│   ├── my-bookings.php             # User bookings page
│   ├── profile.php                 # User profile page
│   ├── about.php                   # About Us page
│   ├── contact.php                 # Contact Us page
│   ├── terms.php                   # Terms and Conditions page
│   ├── privacy.php                 # Privacy Policy page
│   ├── 404.php                     # 404 Not Found page
│   ├── 500.php                     # 500 Internal Server Error page
│   ├── .htaccess                   # URL rewriting + security rules
│
├── admin/                          # Admin panel (optional)
│   ├── login.php                   # Admin login page
│   ├── dashboard.php               # Admin dashboard
│   ├── manage-buses.php            # Manage buses
│   ├── manage-routes.php           # Manage routes
│   ├── manage-schedules.php        # Manage schedules
│   ├── view-bookings.php           # View all bookings
│   └── view-users.php              # View all users
│
├── src/                            # PHP source code (backend logic)
│   ├── config/
│   │   ├── database.php            # Database connection
│   │   └── constants.php           # Constants (BASE_URL, etc.)
│   ├── controllers/                # Business logic
│   │   ├── AuthController.php      # Handles login/registration
│   │   ├── BookingController.php   # Handles bookings
│   │   ├── PaymentController.php   # Processes payments
│   │   └── AdminController.php     # Handles admin actions
│   ├── models/                     # Database interactions
│   │   ├── User.php                # User model
│   │   ├── Bus.php                 # Bus model
│   │   ├── Booking.php             # Booking model
│   │   ├── Payment.php             # Payment model
│   │   └── Admin.php               # Admin model
│   ├── utils/                      # Helper functions
│   │   ├── Session.php             # Session management
│   │   ├── Helpers.php             # Redirect, sanitize functions
│   │   └── Mailer.php              # Email sending utility
│   └── views/                      # Reusable HTML components
│       ├── header.php              # Common header
│       ├── footer.php              # Common footer
│       ├── alerts.php              # Success/error message templates
│       └── admin/                  # Admin-specific views
│           ├── header.php          # Admin header
│           └── footer.php          # Admin footer
│
├── database/                       # SQL files
│   └── bus_booking.sql             # Database schema (exported from MySQL)
│
├── tests/                          # Simple PHP tests (optional)
├── vendor/                         # Composer packages (if used)
│
├── .htaccess                       # Global security rules (deny access to src/)
├── composer.json                   # Composer config (if needed)
└── README.md                       # Setup instructions