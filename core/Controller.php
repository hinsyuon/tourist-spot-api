<?php
require_once "Response.php";
class Controller {
    protected function json($success,$message,$data=null){
        Response::json($success,$message,$data);
    }
}