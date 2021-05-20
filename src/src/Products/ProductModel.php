<?php

namespace Products;

class ProductModel
{
    public $product_ID;
    public $name;
    public $price;
    public $discount;
    public $description;
    public $image;

    public function __get($name)
    {
        switch ($name){
            case 'priceEuro':
                return $this->getPriceEuro();
            case 'discountPriceEuro':
                return $this->getDiscountPriceEuro();
            case 'shortDescription':
                return $this->getShortDescription();
            default:
                return $this->$name;
        }
    }

    private function getPriceEuro()
    {
        return $this->price / 100;
    }

    private function getDiscountPriceEuro()
    {
        return round($this->priceEuro * $this->discount) / 100;
    }

    public function getShortDescription($charsLimit = 150){
        if (strlen($this->description) > $charsLimit)
            return substr($this->description, 0, strrpos(substr($this->description, 0, $charsLimit), " ")).'...';
        else return $this->description;
    }
}