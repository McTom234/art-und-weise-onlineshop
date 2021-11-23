renderShoppingCart();

function renderShoppingCart() {

    const cartList = document.getElementById('cart-list');
    const shoppingCart = getShoppingCart();
    const shoppingCartString = JSON.stringify(shoppingCart);

    if (shoppingCart != null) {
        if (Object.keys(shoppingCart).length > 0) {
            let http = new XMLHttpRequest();
            let url = './fetchShoppingCart';
            let params = `shoppingCart=${shoppingCartString}`;
            http.open('POST', url, true);

            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            http.onreadystatechange = function () {
                if (http.readyState === 4 && http.status === 200) {

                    cartList.innerHTML = '';

                    const heading = document.createElement('h2');
                    heading.innerHTML = "Warenkorb";
                    cartList.prepend(heading);

                    let response = JSON.parse(http.responseText);
                    response.forEach((item, index) => {
                        if (!item) {
                            const shoppingCartKeys = Object.keys(shoppingCart);
                            deleteItem(shoppingCartKeys[index]);
                            return;
                        }

                        const {product_ID} = item;
                        let count = shoppingCart[product_ID];

                        let article = document.createElement('article');

                        let a_itemLink = document.createElement('a')
                        a_itemLink.setAttribute('href', './show?id=' + product_ID);
                        a_itemLink.className = "no-text-decoration article-image";

                        let figure = a_itemLink.cloneNode(false);
                        let figure_element = document.createElement('figure');
                        let img = document.createElement('img');
                        img.setAttribute('src', item.images[0].base64);
                        figure_element.appendChild(img);
                        figure.appendChild(figure_element);

                        let itemTextWrapper = document.createElement('div');
                        itemTextWrapper.className = 'item-description';

                        let itemName = a_itemLink.cloneNode(false);
                        let itemNameE = document.createElement('h3');
                        itemNameE.textContent = item.name;
                        itemName.appendChild(itemNameE);

                        let itemDescription = a_itemLink.cloneNode(false);
                        let itemDescriptionE = document.createElement('p');
                        itemDescriptionE.textContent = item.description;
                        itemDescription.appendChild(itemDescriptionE);

                        const values = [
                            0, 1, 2, 3, 4, 5
                        ];
                        let itemCount = createQuantitySelect(count, values, 100, true, function (number) {

                            if (number === 0) {
                                deleteItem(product_ID);
                                cartList.removeChild(article);
                                renderShoppingCart();
                            } else {
                                setItem(product_ID, number);
                                renderShoppingCart();
                            }
                        });

                        let deleteButton = document.createElement('button');
                        deleteButton.textContent = 'Löschen';
                        deleteButton.addEventListener('click', function () {
                                deleteItem(product_ID);
                                cartList.removeChild(article);
                                if(cartList.childElementCount <= 1){
                                    renderEmptyShoppingCart();
                                }
                            }
                        )

                        let itemPrice = document.createElement('span');
                        itemPrice.textContent = (item.price * count).toFixed(2).replace(".", ",");

                        const itemControl = document.createElement('div');
                        itemControl.className = "item-control";
                        itemControl.appendChild(itemCount);
                        itemControl.appendChild(deleteButton);
                        itemControl.appendChild(itemPrice);

                        article.appendChild(figure);
                        itemTextWrapper.appendChild(itemName);
                        itemTextWrapper.appendChild(itemDescription);
                        itemTextWrapper.appendChild(itemControl);
                        article.appendChild(itemTextWrapper);
                        cartList.appendChild(article);

                    });
                }
            }
            http.send(params);
        }else{
            renderEmptyShoppingCart();
        }
    }


}

function renderEmptyShoppingCart(){
    const buyButton = document.getElementById("buy-button");
    buyButton.remove();

    const cartList = document.getElementById('cart-list');

    const info = document.createElement("p");
    info.textContent = "Dein Warenkorb ist leer!";
    cartList.appendChild(info);
}