<?php
require 'vendor/autoload.php';
require './Controller/userController/userController.php';
require './Controller/classRoomController/classRoomController.php';
require './Controller/classRoomAppointment/classRoomAppointment.php';
require './Controller/appointmentDataController/appointmentDataController.php';
require './Controller/notificationController/notificationController.php';
Flight::route('POST /signin', function(){
    $controller = new userController();
    $controller->signIn();
});

Flight::route('POST /signup', function(){
    $controller = new userController();
    $controller->signUp();
});

Flight::route('POST /classRoom', function(){
    $controller = new classRoom();
    $controller->classRoomFetch();
});

Flight::route('POST /classRoomAppointment', function(){
    $controller = new classRoomAppointment();
    $controller->storeAppointment();
});

Flight::route('GET /appointmentData',function(){
    $controller = new appointmentDataController;
    $controller->fetchData();
});

Flight::route('POST /reservation',function(){
    $controller = new notification;
    $controller->notificationApproved();
});

Flight::route('POST /denyReservation',function(){
    $controller = new notification;
    $controller->denyNotification();
});

Flight::route('POST /getnotidetails', function(){
    $controller = new notification;
    $controller->getNotification();
});
Flight::start();
?>
