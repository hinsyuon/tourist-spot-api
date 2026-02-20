<?php
require_once __DIR__."/../core/Model.php";

class TouristSpot extends Model {
    public const UPLOAD_DIR = __DIR__.'/../storages/';
    public function getAll(){
        return $this->db->query("SELECT * FROM tourist_spots ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data,$file=null){
        $imageName=null;
        if(isset($file['image'])){
            $imageName=time().'_'.$file['image']['name'];
            move_uploaded_file($file['image']['tmp_name'], self::UPLOAD_DIR.$imageName);
        }
        $stmt=$this->db->prepare("
            INSERT INTO tourist_spots (name,description,location,image) 
            VALUES (:name, :description, :location, :image)
        ");
        $stmt->execute([
            ':name' => $data['name'],
            ':description' => $data['description'],
            ':location' => $data['location'],
            ':image' => $imageName
        ]);
    }

    public function update($id,$data){
        $stmt=$this->db->prepare("
            UPDATE tourist_spots 
            SET name=:name, description=:description, location=:location 
            WHERE id=:id
        ");
        $stmt->execute([
            ':name' => $data['name'],
            ':description' => $data['description'],
            ':location' => $data['location'],
            ':id' => $id
        ]);
    }

    public function delete($id){
        $stmt=$this->db->prepare("DELETE FROM tourist_spots WHERE id=:id");
        $stmt->execute([':id' => $id]);
    }
}