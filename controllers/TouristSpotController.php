<?php
require_once __DIR__."/../core/Controller.php";
require_once __DIR__."/../models/TouristSpot.php";
require_once __DIR__."/../middleware/AuthMiddleware.php";

class TouristSpotController extends Controller {

    // GET /tourist-spots
    public function index(){ 
        $this->json(true, "List of tourist spots", (new TouristSpot())->getAll()); 
    }

    // POST /tourist-spots
    public function store(){ 
        AuthMiddleware::check(['admin','editor']); 

        // Use $_POST and $_FILES for form-data/x-www-form-urlencoded
        $data = (object) $_POST;
        $files = $_FILES;

        // Fallback: if JSON body is sent
        if(empty($data->name) && empty($data->description) && empty($data->location)){
            $input = file_get_contents("php://input");
            $data = json_decode($input, true);
        }

        (new TouristSpot())->create($data, $files); 
        $this->json(true, "Tourist spot created successfully"); 
    }

    // PUT /tourist-spots
    public function update(){ 
        AuthMiddleware::check(['admin','editor']); 

        // Parse JSON body
        $data = json_decode(file_get_contents("php://input"), true);

        // Fallback: use $_POST (form-data/x-www-form-urlencoded)
        if(!$data) $data = (object) $_POST;

        if(empty($data->id)) $this->json(false, "ID is required to update");

        (new TouristSpot())->update($data->id, $data); 
        $this->json(true, "Tourist spot updated successfully"); 
    }

    // DELETE /tourist-spots
    public function delete(){ 
        AuthMiddleware::check(['admin']); 

        // Parse JSON body
        $data = json_decode(file_get_contents("php://input"), true);

        // Fallback: use $_POST (form-data/x-www-form-urlencoded)
        if(!$data) $data = (object) $_POST;

        if(empty($data->id)) $this->json(false, "ID is required to delete");

        (new TouristSpot())->delete($data->id); 
        $this->json(true, "Tourist spot deleted successfully"); 
    }
}