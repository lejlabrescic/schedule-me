<?php
require "./connection/db.php";

class modelFetchData
{
    private $conn;

    public function __construct()
    {
        $this->conn = getDatabaseConnection();
    }

    public function fetchDataFromAdmin()
    {
        $sql = "SELECT * FROM `class_room_shedule_table`";
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id, $userId, $classRoomId, $date, $startTime, $endTime);
            $result = array();
            while ($stmt->fetch()) {
                $selectUser = "SELECT `email` FROM `login-info-table` WHERE `id`=?";
                $stmt3 = $this->conn->prepare($selectUser);
                $stmt3->bind_param('i', $userId);
                if ($stmt3->execute()) {
                    $stmt3->bind_result($email);
                    $stmt3->fetch();
                    $row = array(
                        'id'=>$id,
                        'userId'=>$userId,
                        'email' => $email,
                        'date' => $date,
                        'startTime' => $startTime,
                        'endTime' => $endTime,
                        'room_number' => $classRoomId,
                    );
                    $result[] = $row;
                }
                $stmt3->close();
            }
            return $result;
        } else {
            return null;
        }
    }
}
