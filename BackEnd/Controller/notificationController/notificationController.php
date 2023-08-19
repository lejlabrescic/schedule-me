<?php
require __DIR__ . "/../../model/notificationModel/notificationModel.php";

class notification
{
    public static function notificationApproved()
    {
        $userId = Flight::request()->data->userId;
        $roomNumber = Flight::request()->data->roomNumber;
        $postId = Flight::request()->data->postId;
        $model = new notificationModel();
        $result = $model->notificationApprovedCreate($userId, $roomNumber,$postId);
        if ($result === true) {
            Flight::json(array('status' => 'success', 'message' => "The request for room " . $roomNumber . " reservation has been approved!"));
        } elseif ($result === false) {
            Flight::json(array('status' => 'error', 'message' => 'Room not found!'));
        } else {
            Flight::json(array('status' => 'error', 'message' => 'An error occurred while processing the request.'));
        }
    }
    public static function denyNotification(){
        $userId = Flight::request()->data->userId;
        $roomNumber = Flight::request()->data->roomNumber;
        $postId=Flight::request()->data->postId;
        $comment = Flight::request()->data->comment;
        $model =new NotificationModel();
        $result = $model->notificationDeny($userId,$roomNumber,$postId,$comment);
        if ($result === true) {
            Flight::json(array('status' => 'success', 'message' => "The request for room " . $roomNumber . " reservation has been Deny!"));
        } elseif ($result === false) {
            Flight::json(array('status' => 'error', 'message' => 'Room not found!'));
        } else {
            Flight::json(array('status' => 'error', 'message' => 'An error occurred while processing the request.'));
        }
    }
    public static function getNotification(){
        $model = new NotificationModel();
        $userId = Flight::request()->data->userId;
        $result = $model->fetchNotification($userId);
        
        if ($result === null) {
            Flight::json(array('status' => 'error', 'message' => 'Error fetching notifications'));
        } else if (empty($result)) {
            Flight::json(array('status' => 'error', 'message' => 'No notifications found'));
        } else {
            Flight::json(array('status' => 'success', 'data' => $result));
        }
    }
    
}
