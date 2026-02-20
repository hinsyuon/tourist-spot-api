<?php
require_once __DIR__."/../core/Model.php";

class User extends Model {

    public function login($username,$password){
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username=:username");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password,$user['password'])){
            $token = bin2hex(random_bytes(32));
            $update = $this->db->prepare("UPDATE users SET token=:token WHERE id=:id");
            $update->execute([
                ':token' => $token,
                ':id' => $user['id']
            ]);
            $user['token'] = $token;
            return $user;
        }
        return false;
    }

    public function getUserByToken($token){
        if(!$token) return false;
        $stmt = $this->db->prepare("SELECT * FROM users WHERE token=:token");
        $stmt->execute([':token' => $token]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function clearToken($userId){
        $stmt = $this->db->prepare("UPDATE users SET token=NULL WHERE id=:id");
        $stmt->execute([':id' => $userId]);
    }
}