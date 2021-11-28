window.onload = function () {
    renderShoppingCart();
}

function renderShoppingCart() {

    const cartList = document.getElementById('cart-list');
    const shoppingCart = getShoppingCart();
    const shoppingCartString = JSON.stringify(shoppingCart);

    if (shoppingCart != null) {
        if (Object.keys(shoppingCart).length > 0) {
            let http = new XMLHttpRequest();
            let url = './api/cart';
            let params = `cart=${shoppingCartString}`;
            http.open('POST', url, true);

            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            http.onreadystatechange = function () {
                if (http.readyState === 4 && http.status === 200) {

                    // empty div#cart-list
                    cartList.innerHTML = '';

                    // create new heading
                    const heading = document.createElement('h2');
                    heading.innerHTML = "Warenkorb";
                    cartList.prepend(heading);

                    // fetch item data
                    let response = JSON.parse(http.responseText);
                    console.log(response)

                    response.forEach((item, index) => {
                        // if item is not present, delete from shopping cart
                        if (!item) {
                            const shoppingCartKeys = Object.keys(shoppingCart);
                            deleteItem(shoppingCartKeys[index]);
                            return;
                        }

                        // get product ID from response
                        const {product_ID} = item;
                        // get count of product from shopping cart
                        let count = shoppingCart[product_ID];

                        /* object structure
                        article
                            figure
                            name
                            description
                            flex container
                                controls container
                                    quantity selector
                                    delete button
                                price
                         */

                        // create <a/> instance
                        const aPreset = document.createElement('a')
                        aPreset.setAttribute('href', './show?id=' + product_ID);
                        aPreset.className = "no-text-decoration article-image";

                        // create parent of product <article/>
                        const article = document.createElement('article');

                        // create figure for image
                        const figure = document.createElement('figure');
                        const figureLink = aPreset.cloneNode(false);
                        const figureImg = document.createElement('img');
                        //figureImg.setAttribute('src', item.images[0].base64);
                        figureLink.appendChild(figureImg);
                        figure.appendChild(figureLink);

                        // create h3 item title
                        const title = document.createElement('h3');
                        const titleLink = aPreset.cloneNode(false);
                        titleLink.textContent = item.name;
                        title.appendChild(titleLink);

                        // create p item description
                        const description = document.createElement('p');
                        const descriptionLink = aPreset.cloneNode(false);
                        descriptionLink.textContent = item.description;
                        description.appendChild(descriptionLink);

                        // create div flex container for quantity selector, delete button and price
                        const flexContainer = document.createElement('div');
                        // create div item controls container for quantity selector and delete button
                        const controls = document.createElement('div');
                        controls.className = "item-control";

                        const values = [0, 1, 2, 3, 4, 5];
                        const quantitySelect = createQuantitySelect(count, values, 100, true, function (number) {
                            if (number === 0) {
                                deleteItem(product_ID);
                                cartList.removeChild(article);
                                renderShoppingCart();
                            } else {
                                setItem(product_ID, number);
                                renderShoppingCart();
                            }
                        });
                        const deleteButton = document.createElement('button');
                        deleteButton.textContent = 'Löschen';
                        deleteButton.addEventListener('click', function () {
                            deleteItem(product_ID);
                            cartList.removeChild(article);
                            if (cartList.childElementCount <= 1) {
                                renderEmptyShoppingCart();
                            }
                        });
                        controls.appendChild(quantitySelect);
                        controls.appendChild(deleteButton);

                        const price = document.createElement('span');
                        price.textContent = (item.price * count).toFixed(2).replace(".", ",");
                        flexContainer.appendChild(controls);
                        flexContainer.appendChild(price);

                        article.appendChild(figure);
                        article.appendChild(title);
                        article.appendChild(description);
                        article.appendChild(flexContainer);

                        cartList.appendChild(article);
                    });
                }
            }
            http.send(params);
        } else {
            renderEmptyShoppingCart();
        }
    }


}

function renderEmptyShoppingCart() {
    const buyButton = document.getElementById("buy-button");
    buyButton.remove();

    const cartList = document.getElementById('cart-list');

    const info = document.createElement("p");
    info.textContent = "Dein Warenkorb ist leer!";
    cartList.appendChild(info);
}
