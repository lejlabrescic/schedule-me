<?php
require __DIR__."/../../model/classRoomAppointmentModel/classRoomAppointmentModel.php";

class classRoomAppointment {
    public function storeAppointment() {
        $userId = Flight::request()->data->userId;
        $classroomNumber = Flight::request()->data->classroomNumber;
        $selectedDate = Flight::request()->data->selectedDate;
        $startTime = Flight::request()->data->startTime;
        $endTime = Flight::request()->data->endTime;
        $model = new classRoomAppointmentModel();
        $response = $model->storeAppointment($userId, $classroomNumber, $selectedDate, $startTime, $endTime);
        Flight::json($response);
    }
}
?>
