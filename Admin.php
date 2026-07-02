<?php
// models/Admin.php

class Admin {
    /**
     * @var PDO
     */
    private $db;

    /**
     * Admin Model constructor.
     *
     * @param PDO $db
     */
    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * Creates a new admin record.
     *
     * @param array $data Contains full_name, username, email, password (already hashed)
     * @return bool
     */
    public function create(array $data) {
        $sql = "INSERT INTO admins (full_name, username, email, password) VALUES (:full_name, :username, :email, :password)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':full_name' => $data['full_name'],
            ':username'  => $data['username'],
            ':email'     => $data['email'],
            ':password'  => $data['password']
        ]);
    }

    /**
     * Finds an admin user by username or email.
     *
     * @param string $login The username or email identifier
     * @return array|false Returns the associative user record or false if not found
     */
    public function findByUsernameOrEmail(string $login) {
        $sql = "SELECT * FROM admins WHERE username = :username OR email = :email LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':username' => $login,
            ':email'    => $login
        ]);
        return $stmt->fetch();
    }

    /**
     * Checks if a username is already taken.
     *
     * @param string $username
     * @return bool
     */
    public function usernameExists(string $username) {
        $sql = "SELECT COUNT(*) FROM admins WHERE username = :username";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':username' => $username]);
        return $stmt->fetchColumn() > 0;
    }

    /**
     * Checks if an email address is already registered.
     *
     * @param string $email
     * @return bool
     */
    public function emailExists(string $email) {
        $sql = "SELECT COUNT(*) FROM admins WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetchColumn() > 0;
    }
}
