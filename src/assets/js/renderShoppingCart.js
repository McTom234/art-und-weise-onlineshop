renderShoppingCart();

function renderShoppingCart() {

    const cartList = document.getElementById('cart-list');
    const shoppingCart = getShoppingCart();
    const shoppingCartString = JSON.stringify(shoppingCart);

    if (shoppingCart != null) {
        let http = new XMLHttpRequest();
        let url = './fetchShoppingCart';
        let params = `shoppingCart=${shoppingCartString}`;
        http.open('POST', url, true);

        http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        http.onreadystatechange = function () {
            if (http.readyState === 4 && http.status === 200) {

                cartList.innerHTML = '';

                let response = JSON.parse(http.responseText);
                response.forEach((item, index) => {
                    if (!item) {
                        const shoppingCartKeys = Object.keys(shoppingCart);
                        deleteItem(shoppingCartKeys[index]);
                        return;
                    }

                    const {product_ID} = item;
                    let count = shoppingCart[product_ID];

                    let itemBox = document.createElement('article');

                    let itemFigure = document.createElement('figure');
                    let itemImg = document.createElement('img');
                    itemImg.setAttribute('src', item.images[0].base64);
                    itemFigure.appendChild(itemImg);

                    let itemTextWrapper = document.createElement('div');
                    itemTextWrapper.className = 'item-description';

                    let itemName = document.createElement('h3');
                    itemName.textContent = item.name;
                    itemName.addEventListener('click', function () {
                        window.location.href = './show?id=' + product_ID;
                    });

                    let itemDescription = document.createElement('p');
                    itemDescription.textContent = item.description;

                    const values = [
                        0, 1, 2, 3, 4, 5
                    ];
                    let itemCount = createQuantitySelect(count, values, 100, true, function (number) {

                        if (number === 0) {
                            deleteItem(product_ID);
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
                            cartList.removeChild(itemBox);
                        }
                    )

                    const itemControl = document.createElement('div');
                    itemControl.className = "item-control";
                    itemControl.appendChild(itemCount);
                    itemControl.appendChild(deleteButton);

                    let itemPrice = document.createElement('span');
                    // TODO: round value
                    itemPrice.textContent = (item.price * count).toFixed(2).replace(".", ",");

                    itemBox.appendChild(itemFigure);
                    itemTextWrapper.appendChild(itemName);
                    itemTextWrapper.appendChild(itemDescription);
                    itemTextWrapper.appendChild(itemControl);
                    itemBox.appendChild(itemTextWrapper);
                    itemBox.appendChild(itemPrice);
                    cartList.appendChild(itemBox);

                });
            }
        }
        http.send(params);
    }


}