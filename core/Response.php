<?php
class Response {
    public static function json($success,$message,$data=null){
        header("Content-Type: application/json charset=UTF-8");
        echo json_encode(['success'=>$success,'message'=>$message,'data'=>$data]);
        exit;
    }
}