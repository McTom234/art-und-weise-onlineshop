window.deleteItem = function (id) {
    let shoppingCart = getCookies('shoppingCart');
    if (shoppingCart === null) {
        return;
    }
    delete shoppingCart[id];
    setCookies('shoppingCart', shoppingCart);
}

window.setItem = function (id, number = 1, additional = 1) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", '/api/cart/set', true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            console.log(xhr.responseText);
        }
    }
    xhr.send(`id=${id}&number=${number}&additional=${additional}`);
}



