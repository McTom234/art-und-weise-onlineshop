function deleteItem(id) {
    let shoppingCart = getCookies('shoppingCart');
    if (shoppingCart === null) {
        return;
    }
    delete shoppingCart[id];
    setCookies('shoppingCart', shoppingCart);
}

function addItem(id, number = 1) {

    let shoppingCart = getCookies('shoppingCart');
    if (!shoppingCart) {
        shoppingCart = {};
    }

    if(shoppingCart[id]){
        shoppingCart[id] += number;
    }else{
        shoppingCart[id] = number;
    }

    setCookies('shoppingCart', shoppingCart);
}

function setItem(id, count) {

    let shoppingCart = getCookies('shoppingCart');
    if (shoppingCart === null) {
        shoppingCart = {};
    }
    shoppingCart[id] = count;

    setCookies('shoppingCart', shoppingCart);
}

function getShoppingCart() {

    return getCookies('shoppingCart');

}



