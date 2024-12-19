<?php

class Message {
    private $id;
    private $senderId;
    private $receiverId;
    private $content;
    private $type;
    private $timestamp;

    public function __construct($senderId, $receiverId, $content, $type) {
        $this->senderId = $senderId;
        $this->receiverId = $receiverId;
        $this->content = $content;
        $this->type = $type;
        $this->timestamp = date("Y-m-d H:i:s");
    }

    public function save() {
        // Code to save the message to the database
    }

    public static function getMessages($userId1, $userId2) {
        // Code to retrieve messages between two users from the database
    }

    // Getters and Setters
    public function getId() {
        return $this->id;
    }

    public function getSenderId() {
        return $this->senderId;
    }

    public function getReceiverId() {
        return $this->receiverId;
    }

    public function getContent() {
        return $this->content;
    }

    public function getType() {
        return $this->type;
    }

    public function getTimestamp() {
        return $this->timestamp;
    }
}