<?php

namespace Products;

use Core\AbstractController;

class ProductsController extends AbstractController {

    private $productsRepository;

    public function __construct(ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    public function home(){

        $products = $this->productsRepository->fetchNumber(3);

        $this->render("home", [
            'products' => $products
        ]);
    }

    public function show(){

    }
}