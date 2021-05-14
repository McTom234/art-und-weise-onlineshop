
renderShoppingCart();


function renderShoppingCart(){

    const cartList = document.getElementById('cart-list');
    const shoppingCart = getShoppingCart();
    const shoppingCartString = JSON.stringify(shoppingCart);

    if(shoppingCart != null){
        let http = new XMLHttpRequest();
        let url = './fetchShoppingCart';
        let params = `shoppingCart=${shoppingCartString}`;
        http.open('POST', url, true);

        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        http.onreadystatechange = function() {
            if(http.readyState === 4 && http.status === 200) {

                cartList.innerHTML = '';

                let response = JSON.parse(http.responseText);
                response.forEach( item => {
                    let count = shoppingCart[item.product_ID];

                    let itemBox = document.createElement('div');
                    itemBox.addEventListener('click', function (){
                        window.location.href = './show?id=' + item.product_ID;
                    });
                    itemBox.className = 'itemBox';

                    let itemCount = document.createElement('p');
                    itemCount.textContent = 'Anzahl: ' + count;

                    let itemName = document.createElement('h3');
                    itemName.textContent = item.name;

                    let deleteButton = document.createElement('button');
                    deleteButton.textContent = 'Löschen';
                    deleteButton.addEventListener('click', function () {
                        event.stopPropagation();
                        deleteItem(item.product_ID);
                        cartList.removeChild(itemBox);
                        }
                    )


                    itemBox.appendChild(itemName);
                    itemBox.appendChild(itemCount);
                    itemBox.appendChild(deleteButton);
                    cartList.appendChild(itemBox);




                });
            }
        }
        http.send(params);
    }


}

function deleteItem(id){
    let shoppingCart = getCookies('shoppingCart');
    if(shoppingCart === null){
        return;
    }
    delete shoppingCart[id];
    setCookies('shoppingCart', shoppingCart);
}

function addItem(id,  count = 1){

    let shoppingCart = getCookies('shoppingCart');
    if(shoppingCart === null){
        shoppingCart = {};
    }

    if(shoppingCart[id] == null){
        shoppingCart[id] = count;
    }else{
        shoppingCart[id] += count;
    }

    setCookies('shoppingCart', shoppingCart);

    if(name){
        alert(name + ' wurde dem Warenkorb hinzugefügt!');
    }
}

function getShoppingCart(){

    return getCookies('shoppingCart');

}

function setCookies(cookieName, cookieObject, expireDays = 30){

    let cookieString = JSON.stringify(cookieObject);

    let day = new Date();
    day.setTime(day.getTime() + (expireDays*24*60*60*1000));

    document.cookie = `${cookieName}=${cookieString}; expires=${day}; path=/;`
}

function getCookies(cookieName){
    const name = cookieName + '=';
    const decodedCookie = decodeURIComponent(document.cookie);
    const cookieStrings = decodedCookie.split(';');

    for(let i = 0; i <cookieStrings.length; i++) {
        let string = cookieStrings[i];
        while (string.charAt(0) === ' ') {
            string = string.substring(1);
        }
        if (string.indexOf(name) === 0) {
            return JSON.parse(string.substring(name.length, string.length));
        }
    }
    return null;
}

function closePopup() {
    var popup = document.getElementById("myPopup");
    popup.classList.toggle("show");
}