<?php

namespace Products;
use Core\AbstractRepository;
use Images\ImagesRepository;
use PDO;

class ImagesProductsRepository extends AbstractRepository {

    private $imagesRepository;

    public function __construct(PDO $pdo, ImagesRepository $imagesRepository)
    {
        parent::__construct($pdo);

        $this->imagesRepository = $imagesRepository;

    }

    public function getModel()
    {
        return "Products\\ImageProductModel";
    }

    public function getTable()
    {
        return "`image-product`";
    }

    public function getIdName()
    {
        return "image_ID";
    }

    public function fetchByProductID($product_ID){
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE product_ID  = :product_ID");
        $statement->execute(['product_ID' => $product_ID]);
        $imagesProducts = $statement->fetchAll(PDO::FETCH_CLASS, $this->model);

        foreach($imagesProducts AS $imageProduct){
            $image = $this->imagesRepository->fetch($imageProduct->image_ID);
            if($image){
                $imageProduct->base64 = $image->base64;
            }
        }

        return $imagesProducts;
    }

    public function removeByProductID($product_ID){
        $imageProducts = $this->fetchByProductID($product_ID);
        if($imageProducts){
            foreach ($imageProducts as $imageProduct){
                $this->imagesRepository->remove($imageProduct->image_ID);
            }
        }

        $statement = $this->pdo->prepare("DELETE FROM `image-product` WHERE product_ID = :id");
        return $statement->execute(['id' => $product_ID]);
    }

    public function insertImage($product_ID, $image){
        $image_ID = $this->imagesRepository->insertImage($image);

        $statement = $this->pdo->prepare("INSERT INTO $this->table (image_ID, product_ID) VALUES (:image_ID, :product_ID)");
        $statement->execute([
            'image_ID' => $image_ID,
            'product_ID' => $product_ID
        ]);
    }
}
