<?php
require __DIR__."/../../model/userModel/userModel.php";
    class userController{
        public function signIn() {
            $email = Flight::request()->data->email;
            $password = Flight::request()->data->password;
    
            $model = new UserModel();
            $result = $model->checkUserCredentials($email, $password);
    
            if ($result['isLoggedIn']) {
                Flight::json(array('status' => 'success', 'message' => 'Login successful!', 'user_id' => $result['user_id'], 'role'=>$result['role']));
            } else {
                Flight::json(array('status' => 'error', 'message' => 'Invalid credentials!'));
            }
        }
        public function signUp() {
            $email = Flight::request()->data->email;
            $password = Flight::request()->data->password;
            $role = Flight::request()->data->role;
    
            $model = new UserModel();
            $isInserted = $model->insertUserCredentials($email, $password,$role);
    
            if ($isInserted) {
                Flight::json(array('status' => 'success', 'message' => 'Registration successful!'));
            } else {
                Flight::json(array('status' => 'error', 'message' => 'Registration failed!'));
            }
        }
    }
?>