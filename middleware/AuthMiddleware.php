<?php
require_once __DIR__."/../models/User.php";
require_once __DIR__."/../core/Response.php";

class AuthMiddleware {
    public static function check($roles=[]){
        $headers = getallheaders();
        $token = $headers['Authorization'] ?? null;
        // Expect: Authorization: Bearer TOKEN
        if (!$token || !str_starts_with($token, 'Bearer ')) {
            Response::json(false, "Unauthorized: Token missing");
        }

        $token = str_replace('Bearer ', '', $token);
        $userModel = new User();
        $user = $userModel->getUserByToken($token);

        if(!$token || !$user) Response::json(false,"Unauthorized");

        if(!empty($roles) && !in_array($user['role'],$roles))
            Response::json(false,"Forbidden: insufficient role");

        return $user;
    }
}