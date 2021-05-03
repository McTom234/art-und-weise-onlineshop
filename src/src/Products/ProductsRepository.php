<?php

namespace Products;
use Core\AbstractRepository;

class ProductsRepository extends AbstractRepository {

    public function getModel()
    {
        return "Products\\ProductModel";
    }

    public function getTable()
    {
        return "product";
    }

    public function getIdName()
    {
        return "product_ID";
    }
}