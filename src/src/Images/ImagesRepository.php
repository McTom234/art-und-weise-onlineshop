<?php

namespace Images;
use Core\AbstractRepository;
use PDO;

class ImagesRepository extends AbstractRepository {

    public function getModel()
    {
        return "Images\\ImageModel";
    }

    public function getTable()
    {
        return "image";
    }

    public function getIdName()
    {
        return "image_ID";
    }

    public function insertImage($image){
        $image_base64 = base64_encode($image);
        $statement = $this->pdo->prepare("INSERT INTO $this->table (base64) VALUES (:image_base64)");
        $statement->execute(['image_base64' => $image_base64]);
        return $this->pdo->lastInsertId();
    }
}
