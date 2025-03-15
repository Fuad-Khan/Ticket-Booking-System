<?php

class Mailer {
    // Send an email
    public static function sendEmail($to, $subject, $message, $headers = '') {
        // Basic email headers
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
        $headers .= "From: no-reply@yourdomain.com" . "\r\n";

        // Send email using PHP's mail() function
        return mail($to, $subject, $message, $headers);
    }

    // Send a password reset email
    public static function sendPasswordResetEmail($email, $resetLink) {
        $subject = "Password Reset Request";
        $message = "
            <html>
            <head>
                <title>Password Reset Request</title>
            </head>
            <body>
                <p>We received a request to reset your password. Please click the link below to reset it:</p>
                <a href='$resetLink'>Reset Password</a>
                <p>If you did not request this, please ignore this email.</p>
            </body>
            </html>
        ";

        return self::sendEmail($email, $subject, $message);
    }
}
?>
