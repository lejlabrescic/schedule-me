<?php
require __DIR__ . "/../../model/datafetchAppointment/modelFetchData.php";

class appointmentDataController
{
    public function fetchData()
    {
        $modelFetchData = new modelFetchData();
        $data = $modelFetchData->fetchDataFromAdmin();
        if ($data !== null) {
            Flight::json($data);
        } else {
            $response = array('status' => 'error', 'message' => 'No data found.');
            Flight::json($response);
        }
    }
}
