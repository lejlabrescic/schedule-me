<?php
require "./connection/db.php";

class classRoomModel {
    private $conn;

    public function __construct() {
        $this->conn = getDatabaseConnection();
    }

    public function fetchDetailAccordingToRoomNumber($classRoomNumber) {
        $sql = "SELECT * FROM `particular_room_table` WHERE `room_number`=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $classRoomNumber);

        if ($stmt->execute()) {
            $stmt->store_result();
            $stmt->bind_result($id, $room_number, $feature_room,$adminApproval, $description, $image);
            
            // Create an associative array to store the fetched data
            $result = array();

            while ($stmt->fetch()) {
                $data = array(
                    'id' => $id,
                    'room_number' => $room_number,
                    'feature_room' => $feature_room,
                    'adminApproval'=>$adminApproval,
                    'description' => $description,
                    'image' => $image
                );

                // Add the data to the result array
                $result[] = $data;
            }

            // Return the result array
            return $result;
        } else {
            // Return false if there was an error in executing the query
            return false;
        }
    }
}
?>
