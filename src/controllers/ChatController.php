<?php

class ChatController {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function sendMessage($senderId, $receiverId, $content, $type) {
        $stmt = $this->db->prepare("INSERT INTO messages (sender_id, receiver_id, content, type, timestamp) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("iiss", $senderId, $receiverId, $content, $type);
        return $stmt->execute();
    }

    public function getMessages($userId, $contactId) {
        $stmt = $this->db->prepare("SELECT * FROM messages WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) ORDER BY timestamp ASC");
        $stmt->bind_param("iiii", $userId, $contactId, $contactId, $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getTypingIndicator($userId, $contactId) {
        // Logic to get typing indicator status
    }
}