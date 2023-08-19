<?php
require "./connection/db.php";

class notificationModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = getDatabaseConnection();
    }

    public function notificationApprovedCreate($userId, $roomNumber, $postId)
    {
        $message = "Your request for room " . $roomNumber . " reservation has been approved!";
        $sql = "INSERT INTO `reservation`(`userId`, `message`, `room_number`) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('iss', $userId, $message, $roomNumber);

        if ($stmt->execute()) {
            $sqlDelete = "DELETE FROM `class_room_shedule_table` WHERE `id` = ?";
            $stmt2 = $this->conn->prepare($sqlDelete);
            $stmt2->bind_param('i', $postId);
            if ($stmt2->execute()) {
                return true;
            }
        } else {
            return false;
        }
    }
    public function notificationDeny($userId, $roomNumber, $postId, $comment)
    {
        $sql = "INSERT INTO `reservation`(`userId`, `message`, `room_number`) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('iss', $userId, $comment, $roomNumber);

        if ($stmt->execute()) {
            $sqlDelete = "DELETE FROM `class_room_shedule_table` WHERE `id` = ?";
            $stmt2 = $this->conn->prepare($sqlDelete);
            $stmt2->bind_param('i', $postId);
            if ($stmt2->execute()) {
                return true;
            }
        } else {
            return false;
        }
    }
    public function fetchNotification($userId)
    {
        $sql = "SELECT `message`, `room_number` FROM `reservation` WHERE `userId` = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            return null; // Return null to indicate an error with the SQL statement
        }

        $stmt->bind_param('i', $userId);
        if (!$stmt->execute()) {
            return null; // Return null to indicate an error with executing the statement
        }

        $result = $stmt->get_result();
        $notifications = array();

        while ($row = $result->fetch_assoc()) {
            $notification = array(
                'message' => $row['message'],
                'room_number' => $row['room_number'],
            );
            $notifications[] = $notification;
        }

        return $notifications;
    }

}
