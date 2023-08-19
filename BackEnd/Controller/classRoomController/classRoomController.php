<?php
require __DIR__."/../../model/classRoomModel.php/classRoomModel.php";

class classRoom{
    public static function classRoomFetch(){
        $classRoomNumber = Flight::request()->data->classroomNumber;
        $model = new classRoomModel();
        $result = $model->fetchDetailAccordingToRoomNumber($classRoomNumber);
        if ($result) {
            Flight::json(array('status' => 'success', 'data' => $result));
        } else {
            Flight::json(array('status' => 'error', 'message' => 'Room not found!'));
        }
    }
}
?>
