<?php
require_once __DIR__."/../core/Controller.php";
require_once __DIR__."/../models/User.php";

class UserController extends Controller {
    public function login(){
        // Try JSON body first
        $input = file_get_contents("php://input");
        $data = json_decode($input);

        // If JSON empty, fallback to $_POST (form-data or x-www-form-urlencoded)
        if(!$data){
            $data = (object) $_POST;
        }

        // Validate
        if(empty($data->username) || empty($data->password)){
            $this->json(false,"Username and password are required");
        }

        $user = (new User())->login($data->username,$data->password);
        if($user) $this->json(true,"Login successful",$user);
        else $this->json(false,"Invalid credentials");
    }
    public function logout(){
        $user = (Object)AuthMiddleware::check();
        (new User())->clearToken($user->id);
        $this->json(true,"Logout successful");
    }
}