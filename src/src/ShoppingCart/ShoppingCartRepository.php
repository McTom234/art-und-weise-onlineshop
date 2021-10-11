<?php
namespace ShoppingCart;

class ShoppingCartRepository {

    public function getProductCount()
    {
        $count = 0;
        if (isset($_COOKIE['shoppingCart'])) {
            $shoppingCartIDs = json_decode($_COOKIE['shoppingCart'], true);

            foreach ($shoppingCartIDs as $product_ID => $quantity) {
                $count += $quantity;
            }

        }
        return $count;
    }

    public function removeAllProducts(){
        setcookie('shoppingCart', null);
    }
}
