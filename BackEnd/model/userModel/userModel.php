<?php
require "./connection/db.php";
class UserModel {
    private $conn;

    public function __construct() {
        $this->conn = getDatabaseConnection();
    }

    public function checkUserCredentials($email, $password) {
        $sql = "SELECT `id`,`role`, `password` FROM `login-info-table` WHERE `email` = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->bind_result($user_id,$role, $hashedPassword);
        $stmt->fetch();
        $stmt->close();
       
        $isLoggedIn = password_verify($password, $hashedPassword);
        var_dump($isLoggedIn);
        return array('isLoggedIn' => $isLoggedIn, 'user_id' => $user_id,'role'=>$role);
    }

    public function insertUserCredentials($email, $password,$role) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `login-info-table` (`email`, `password`, `role`) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sss', $email, $hashedPassword,$role);

        try {
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }
}
