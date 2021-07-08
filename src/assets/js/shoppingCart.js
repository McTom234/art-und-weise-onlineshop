renderShoppingCart();

document.addEventListener("click", closeAllQuantitySelects);

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

                    let itemBox = document.createElement('div');

                    itemBox.className = 'itemBox';

                    let itemImage = document.createElement('img');
                    itemImage.setAttribute('src', "data:image/png;base64," + item.images[0].base64);
                    itemImage.className = 'itemImage';

                    let itemTextWrapper = document.createElement('div');
                    itemTextWrapper.className = 'itemTextWrapper'

                    const values = [
                        0, 1, 2, 3, 4, 5
                    ];

                    let itemCount = createQuantitySelect(count, values, 100, true, function (number) {

                        if (number === 0) {
                            deleteItem(product_ID);
                            renderShoppingCart();
                        } else {
                            addItem(product_ID, number);
                        }
                    });


                    let itemName = document.createElement('h3');
                    itemName.textContent = item.name;
                    itemName.addEventListener('click', function () {
                        window.location.href = './show?id=' + product_ID;
                    });


                    let itemDescription = document.createElement('p');
                    itemDescription.textContent = item.description;


                    let deleteButton = document.createElement('button');
                    deleteButton.textContent = 'Löschen';
                    deleteButton.addEventListener('click', function () {
                            deleteItem(product_ID);
                            cartList.removeChild(itemBox);
                        }
                    )

                    itemBox.appendChild(itemImage);
                    itemTextWrapper.appendChild(itemName);
                    itemTextWrapper.appendChild(itemDescription);
                    itemBox.appendChild(itemTextWrapper);
                    itemBox.appendChild(itemCount);
                    itemBox.appendChild(deleteButton);
                    cartList.appendChild(itemBox);

                });
            }
        }
        http.send(params);
    }


}

function deleteItem(id) {
    let shoppingCart = getCookies('shoppingCart');
    if (shoppingCart === null) {
        return;
    }
    delete shoppingCart[id];
    setCookies('shoppingCart', shoppingCart);
}

function addItem(id, count = 1) {

    let shoppingCart = getCookies('shoppingCart');
    if (shoppingCart === null) {
        shoppingCart = {};
    }
    shoppingCart[id] = count;


    setCookies('shoppingCart', shoppingCart);

    if (name) {
        alert(name + ' wurde dem Warenkorb hinzugefügt!');
    }
}

function getShoppingCart() {

    return getCookies('shoppingCart');

}

function setCookies(cookieName, cookieObject, expireDays = 30) {

    let cookieString = JSON.stringify(cookieObject);

    let day = new Date();
    day.setTime(day.getTime() + (expireDays * 24 * 60 * 60 * 1000));

    document.cookie = `${cookieName}=${cookieString}; expires=${day}; path=/;`
}

function getCookies(cookieName) {
    const name = cookieName + '=';
    const decodedCookie = decodeURIComponent(document.cookie);
    const cookieStrings = decodedCookie.split(';');

    for (let i = 0; i < cookieStrings.length; i++) {
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
    let popup = document.getElementById("myPopup");
    popup.classList.toggle("show");
}

function createQuantitySelect(defaultValue, values, maxValue, isLastExtends, onSelect) {
    let quantitySelect = document.createElement("div");
    quantitySelect.className = "quantity-select";


    let quantityInput;


    let defaultElement = document.createElement("div");
    defaultElement.className = "select-selected";
    defaultElement.textContent = "Menge: " + defaultValue;

    quantitySelect.append(defaultElement);

    let dropdown = document.createElement("div");
    dropdown.className = "select-items select-hide";

    for (let i = 0; i < values.length; i++) {
        let element = document.createElement("div");

        if (isLastExtends && i >= values.length - 1) {
            element.textContent = values[i] + "+";
            element.addEventListener('click', function () {

                defaultElement.classList.toggle("hide");
                quantityInput.classList.toggle("hide");

            });
            dropdown.append(element);
            continue;
        }


        if (values[i] === 0) {
            element.textContent = values[i] + " (Löschen)";
        } else {
            element.textContent = values[i];
        }

        element.addEventListener('click', function () {

            onSelect(values[i]);
            defaultElement.textContent = "Menge: " + this.textContent;

            let selectedElements = dropdown.getElementsByClassName("same-as-selected");

            for (let k = 0; k < selectedElements.length; k++) {
                selectedElements[k].removeAttribute("class");
            }

            this.className = "same-as-selected";

            closeAllQuantitySelects();
        })

        dropdown.append(element);
    }

    quantitySelect.append(dropdown);

    defaultElement.addEventListener("click", function (e) {
        e.stopPropagation();
        dropdown.classList.toggle("select-hide");
        this.classList.toggle("select-arrow-active");
    });


    if (isLastExtends) {

        quantityInput = document.createElement("div");


        const inputStartValue = values[values.length - 1];


        let input = document.createElement("input");
        input.type = "number";
        input.min = "0";
        input.max = maxValue;
        input.value = inputStartValue;

        let button = document.createElement("button");
        button.textContent = "Aktualisieren";

        function submit() {

            if (input.value < inputStartValue) {
                onSelect(input.value)

                defaultElement.classList.toggle("hide");
                quantityInput.classList.toggle("hide");


                defaultElement.textContent = "Menge: " + input.value;

                let elements = dropdown.children;

                for (let i = 0; i < elements.length; i++) {
                    if (input.value === elements[i].textContent) {
                        elements[i].className = "same-as-selected";
                    } else {
                        elements[i].removeAttribute("class");
                    }
                }

                input.value = inputStartValue;

            } else {
                onSelect(input.value)
                button.className = "hide";
                input.blur();
            }


        }


        input.addEventListener("keyup", function (event) {
            if (event.key === "Enter") {
                submit();
            }
        });

        input.addEventListener("input", function () {
            button.removeAttribute("class");

            if (input.value > maxValue) {
                input.value = maxValue;
            }

            if (input.value < 0) {
                input.value = '';
            }

        });


        if (defaultValue >= inputStartValue) {
            quantityInput.className = "quantity-input";
            defaultElement.classList.toggle("hide");
            button.className = "hide";
        } else {
            quantityInput.className = "quantity-input hide";
        }

        button.addEventListener('click', submit);


        quantityInput.append(input);
        quantityInput.append(button);
        quantitySelect.append(quantityInput);

    }


    return quantitySelect;
}

function closeAllQuantitySelects() {
    let selectItems = document.getElementsByClassName("select-items");
    let selectSelected = document.getElementsByClassName("select-selected");

    for (let i = 0; i < selectSelected.length; i++) {

        selectSelected[i].classList.remove("select-arrow-active");

    }
    for (let i = 0; i < selectItems.length; i++) {
        selectItems[i].classList.add("select-hide");
    }
}