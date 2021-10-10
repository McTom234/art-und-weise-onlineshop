<?php

namespace Categories;

use Core\AbstractRepository;
use PDO;
use Products\ProductsRepository;

class CategoriesRepository extends AbstractRepository
{

    public $productRepository;

    public function __construct(PDO $pdo, ProductsRepository $productRepository)
    {
        parent::__construct($pdo);

        $this->productRepository = $productRepository;

    }

    public function getModel()
    {
        return "Categories\\CategoryModel";
    }

    public function getTable()
    {
        return "category";
    }

    public function getIdName()
    {
        return "category_ID";
    }

    public function fetch($id)
    {
        $category = parent::fetch($id);
        if($category){
            $statement = $this->pdo->prepare("SELECT product_ID FROM `category-product` WHERE category_ID = :category_ID");
            $statement->execute([
                ':category_ID' => $category->category_ID,
            ]);
            $product_IDs = $statement->fetchAll();
            foreach ($product_IDs as $product_ID){
                $product = $this->productRepository->fetch($product_ID[0]);
                array_push($category->products, $product);
            }
        }
        return $category;
    }

    public function fetchAllWithProducts()
    {
        $categories = parent::fetchAll();
        foreach ($categories as $category){
            $statement = $this->pdo->prepare("SELECT product_ID FROM `category-product` WHERE category_ID = :category_ID");
            $statement->execute([
                ':category_ID' => $category->category_ID,
            ]);
            $product_IDs = $statement->fetchAll();
            foreach ($product_IDs as $product_ID){
                $product = $this->productRepository->fetch($product_ID[0]);
                array_push($category->products, $product);
            }
        }
        return $categories;
    }

    public function fetchByProductID($product_ID)
    {
        $statement = $this->pdo->prepare("SELECT category.category_ID, name FROM `category-product` RIGHT JOIN category ON category.category_ID = `category-product`.category_ID WHERE product_ID = :product_ID");
        return $statement->execute([
            ':product_ID' => $product_ID,
        ]);
    }

    public function removeProductCategory($product_ID)
    {
        $statement = $this->pdo->prepare("DELETE FROM `category-product` WHERE product_ID = :product_ID");
        return $statement->execute([
            ':product_ID' => $product_ID,
        ]);
    }

    public function insertProductCategory($category_ID, $product_ID)
    {
        $statement = $this->pdo->prepare("INSERT INTO `category-product` (category_ID, product_ID) VALUES (:category_ID, :product_ID)");
        return $statement->execute([
            ':category_ID' => $category_ID,
            ':product_ID' => $product_ID,
        ]);
    }

    public function insertCategory($name)
    {
        $category_ID = md5(uniqid(rand(), true));

        $statement = $this->pdo->prepare("INSERT INTO category (category_ID, name) VALUES (:category_ID, :name)");
        $statement->execute([
            ':category_ID' => $category_ID,
            'name' => $name,
        ]);
        return $category_ID;
    }

}
