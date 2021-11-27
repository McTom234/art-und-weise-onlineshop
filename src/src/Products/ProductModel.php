<?php

namespace Products;

class ProductModel
{
    public $product_ID;
    public $name;
    public $price;
    public $discount;
    public $description;
    public $images;

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
        return number_format($this->price / 100, 2);
    }

    private function getDiscountPriceEuro()
    {
        if($this->discount == 100) return  $this->priceEuro;
        return number_format($this->priceEuro * $this->discount / 100, 2);
    }

    public function getShortDescription($charsLimit = 150){
        if (strlen($this->description) > $charsLimit)
            return substr($this->description, 0, strrpos(substr($this->description, 0, $charsLimit), " ")).'...';
        else return $this->description;
    }
}