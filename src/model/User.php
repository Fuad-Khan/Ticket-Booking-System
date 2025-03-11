<?php
class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Register a new user
    public function register($name, $email, $phone, $passwordHash) {
        $stmt = $this->pdo->prepare("
            INSERT INTO Users (name, email, phone, password)
            VALUES (:name, :email, :phone, :password)
        ");
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':password' => $passwordHash,
        ]);
    }

    // Get user by email
    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM Users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get user by phone
    public function getUserByPhone($phone) {
        $stmt = $this->pdo->prepare("SELECT * FROM Users WHERE phone = :phone");
        $stmt->execute([':phone' => $phone]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get user by ID
    public function getUserById($userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM Users WHERE user_id = :user_id");
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update user profile
    public function updateUser($userId, $name, $email, $phone) {
        $stmt = $this->pdo->prepare("
            UPDATE Users
            SET name = :name, email = :email, phone = :phone
            WHERE user_id = :user_id
        ");
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':user_id' => $userId,
        ]);
    }

    // Delete a user (optional)
    public function deleteUser($userId) {
        $stmt = $this->pdo->prepare("DELETE FROM Users WHERE user_id = :user_id");
        return $stmt->execute([':user_id' => $userId]);
    }
}
?>