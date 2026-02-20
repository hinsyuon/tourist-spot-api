<?php
require_once __DIR__."/../controllers/UserController.php";
require_once __DIR__."/../controllers/TouristSpotController.php";

$uri = $_SERVER['REQUEST_URI'];
$uri = parse_url($uri, PHP_URL_PATH);
$uri = preg_replace('#^/api/v1#', '', $uri);
$uri = rtrim($uri, '/');

$method = $_SERVER['REQUEST_METHOD'];

if($uri==="/auth/login" && $method==="POST") (new UserController())->login();
elseif($uri==="/auth/logout" && $method==="POST") (new UserController())->logout();
elseif($uri==="/tourist-spots" && $method==="GET") (new TouristSpotController())->index();
elseif($uri==="/tourist-spots" && $method==="POST") (new TouristSpotController())->store();
elseif($uri==="/tourist-spots" && $method==="PUT") (new TouristSpotController())->update();
elseif($uri==="/tourist-spots" && $method==="DELETE") (new TouristSpotController())->delete();
else echo json_encode(['error'=>"Route not found"]);