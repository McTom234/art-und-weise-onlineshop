window.deleteItem = function (id) {
    let shoppingCart = getCookies('shoppingCart');
    if (shoppingCart === null) {
        return;
    }
    delete shoppingCart[id];
    setCookies('shoppingCart', shoppingCart);
}

window.addItem = function (id, number = 1) {

    let shoppingCart = getCookies('shoppingCart');
    if (!shoppingCart) {
        shoppingCart = {};
    }

    if (shoppingCart[id]) {
        shoppingCart[id] += number;
    } else {
        shoppingCart[id] = number;
    }

    setCookies('shoppingCart', shoppingCart);
}

window.setItem = function (id, count) {

    let shoppingCart = getCookies('shoppingCart');
    if (shoppingCart === null) {
        shoppingCart = {};
    }
    shoppingCart[id] = count;

    setCookies('shoppingCart', shoppingCart);
}

window.getShoppingCart = function () {

    return getCookies('shoppingCart');

}



