<?php
class Message {
    private $conn;
     private $users_table = 'users';
    private $table = "messages";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function sendMessage($sender_id, $subject, $message_text) {
        try {
            $sql = "INSERT INTO {$this->table} (sender_id, subject, message_text)
                    VALUES (:sender, :subject, :message)";
            
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':sender'  => $sender_id,
                ':subject' => $subject,
                ':message' => $message_text
            ]);
        } catch (PDOException $e) {
            error_log("Send message error: " . $e->getMessage());
            return false;
        }
    }

   public function getAllMessagesForAdmin() {
    $sql = "SELECT m.id, m.sender_id, m.receiver_id, m.message_text, m.subject, m.is_read, m.created_at,
                   d.first_name, d.last_name, u.email
            FROM {$this->table} m
            INNER JOIN users u ON m.sender_id = u.id
            LEFT JOIN donors d ON u.id = d.id
            WHERE m.receiver_id IS NULL OR m.receiver_id IN (
                SELECT id FROM users WHERE role_id = 1
            )
            ORDER BY m.created_at DESC";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function getMessageById($id) {
    $sql = "SELECT m.id, m.sender_id, m.receiver_id, m.subject, m.message_text, m.is_read, m.created_at,
                   d.first_name, d.last_name, u.email
            FROM messages m
            INNER JOIN users u ON m.sender_id = u.id
            LEFT JOIN donors d ON u.id = d.id
            WHERE m.id = :id";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function sendReply($sender_id, $receiver_id, $subject, $message_text) {
    try {
        $sql = "INSERT INTO {$this->table} (sender_id, receiver_id, subject, message_text, is_read) 
                VALUES (:sender_id, :receiver_id, :subject, :message_text, 0)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':sender_id', $sender_id);
        $stmt->bindParam(':receiver_id', $receiver_id);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':message_text', $message_text);
        
        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("Reply Error: " . $e->getMessage());
        return false;
    }
}

    public function deleteMessage($id) {
    try {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("Delete Message Error: " . $e->getMessage());
        return false;
    }
}

}
?>
