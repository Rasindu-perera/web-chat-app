<?php

class User {
    private $id;
    private $username;
    private $password;
    private $email;
    private $status;

    public function __construct($id, $username, $password, $email, $status) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->status = $status;
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

    public function getEmail() {
        return $this->email;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public static function findById($id) {
        // Logic to find a user by ID from the database
    }

    public static function findByUsername($username) {
        // Logic to find a user by username from the database
    }

    public static function create($username, $password, $email) {
        // Logic to create a new user in the database
    }

    public static function update($id, $data) {
        // Logic to update user information in the database
    }

    public static function delete($id) {
        // Logic to delete a user from the database
    }
}