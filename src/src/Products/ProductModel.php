<?php

namespace Products;

class ProductModel
{
    public $product_ID;
    public $name;
    public $price;
    public $discountPercent;
    public $description;

    public function __get($name)
    {
        switch ($name){
            case 'discountPrice':
                return $this->getDiscountPrice();
            case 'shortDescription':
                return $this->getShortDescription();
            default:
                return $this->$name;
        }
    }

    private function getDiscountPrice()
    {
        return $this->price / $this->discountPercent * 100;
    }

    public function getShortDescription($charsLimit = 150){
        if (strlen($this->description) > $charsLimit)
            return substr($this->description, 0, strrpos(substr($this->description, 0, $charsLimit), " ")).'...';
        else return $this->description;
    }
}