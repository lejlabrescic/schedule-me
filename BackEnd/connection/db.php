<?php
if (!function_exists('getDatabaseConnection')) {
function getDatabaseConnection() {
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'schoolkindweb';
    $db = new mysqli($host, $username, $password, $database);
    if ($db->connect_errno) {
        die("Failed to connect to MySQL: " . $db->connect_error);
    }
    $db->set_charset("utf8");

    return $db;
}
}
