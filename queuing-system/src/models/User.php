<?php

class User {
    private $id;
    private $username;
    private $password;
    private $role;

    public function __construct($id, $username, $password, $role) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRole() {
        return $this->role;
    }

    public function validatePassword($password) {
        return password_verify($password, $this->password);
    }

    public static function findById($id, $pdo) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? new self($user['id'], $user['username'], $user['password'], $user['role']) : null;
    }

    public static function findByUsername($username, $pdo) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? new self($user['id'], $user['username'], $user['password'], $user['role']) : null;
    }
}