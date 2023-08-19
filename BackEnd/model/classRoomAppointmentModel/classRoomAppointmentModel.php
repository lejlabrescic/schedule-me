<?php
require "./connection/db.php";

class classRoomAppointmentModel {
    private $conn;

    public function __construct() {
        $this->conn = getDatabaseConnection();
    }

    public function storeAppointment($userId, $classroomNumber, $selectedDate, $startTime, $endTime) {
        if ($this->isClassRoomAvailable($classroomNumber, $selectedDate, $startTime, $endTime)) {
            $sql = "INSERT INTO `class_room_shedule_table` (`userId`, `classRoomId`, `date`, `startTime`, `endTime`) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('iisss', $userId, $classroomNumber, $selectedDate, $startTime, $endTime);

            try {
                if ($stmt->execute()) {
                    return array('status' => 'success', 'message' => 'Appointment stored successfully!');
                } else {
                    return array('status' => 'error', 'message' => 'Failed to store appointment.');
                }
            } catch (Exception $e) {
                return array('status' => 'error', 'message' => 'An error occurred while storing the appointment.');
            }
        } else {
            return array('status' => 'error', 'message' => 'The class room is already booked during the selected time slot.');
        }
    }

    private function isClassRoomAvailable($classroomNumber, $selectedDate, $startTime, $endTime) {
        $sql = "SELECT COUNT(*) FROM `class_room_shedule_table` WHERE `classRoomId` = ? AND `date` = ? AND ((`startTime` <= ? AND `endTime` >= ?) OR (`startTime` <= ? AND `endTime` >= ?))";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('isssss', $classroomNumber, $selectedDate, $startTime, $startTime, $endTime, $endTime);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        return $count === 0;
    }
}
?>
