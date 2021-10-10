<?php

namespace Category;

use Core\AbstractRepository;
use PDO;

class CategoriesRepository extends AbstractRepository
{

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

    public function insertImage($image)
    {
        $image_ID = md5(uniqid(rand(), true));
        $statement = $this->pdo->prepare("INSERT INTO image (image_ID, base64) VALUES (:image_ID, :image_base64)");
        $statement->execute([
            ':image_ID' => $image_ID,
            ':image_base64' => $image
        ]);
        return $image_ID;
    }
}
