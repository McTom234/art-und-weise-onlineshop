/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************************!*\
  !*** ./resources/js/renderShoppingCart.js ***!
  \********************************************/
window.onload = function () {
  renderShoppingCart();
};

function renderShoppingCart() {
  var cartList = document.getElementById('cart-list');
  var shoppingCart = getShoppingCart();
  var shoppingCartString = JSON.stringify(shoppingCart);

  if (shoppingCart != null) {
    if (Object.keys(shoppingCart).length > 0) {
      var http = new XMLHttpRequest();
      var url = './api/cart';
      var params = "cart=".concat(shoppingCartString);
      http.open('POST', url, true);
      http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

      http.onreadystatechange = function () {
        if (http.readyState === 4 && http.status === 200) {
          // empty div#cart-list
          cartList.innerHTML = ''; // create new heading

          var heading = document.createElement('h2');
          heading.innerHTML = "Warenkorb";
          cartList.prepend(heading); // fetch item data

          var response = JSON.parse(http.responseText);
          console.log(response);
          response.forEach(function (item, index) {
            // if item is not present, delete from shopping cart
            if (!item) {
              var shoppingCartKeys = Object.keys(shoppingCart);
              deleteItem(shoppingCartKeys[index]);
              return;
            } // get product ID from response


            var product_ID = item.product_ID; // get count of product from shopping cart

            var count = shoppingCart[product_ID];
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
            // check figure creation

            var image = true;
            if (!item.images.length > 0) image = false; // create <a/> instance

            var aPreset = document.createElement('a');
            aPreset.setAttribute('href', './show?id=' + product_ID);
            aPreset.className = "no-text-decoration article-image"; // create parent of product <article/>

            var article = document.createElement('article');
            if (!image) article.className = "no-figure"; // create figure for image

            var figure = null;

            if (image) {
              figure = document.createElement('figure');
              var figureLink = aPreset.cloneNode(false);
              var figureImg = document.createElement('img');
              figureImg.setAttribute('src', item.images[0].base64);
              figureLink.appendChild(figureImg);
              figure.appendChild(figureLink);
            } // create h3 item title


            var title = document.createElement('h3');
            var titleLink = aPreset.cloneNode(false);
            titleLink.textContent = item.name;
            title.appendChild(titleLink); // create p item description

            var description = document.createElement('p');
            var descriptionLink = aPreset.cloneNode(false);
            descriptionLink.textContent = item.description;
            description.appendChild(descriptionLink); // create div flex container for quantity selector, delete button and price

            var flexContainer = document.createElement('div'); // create div item controls container for quantity selector and delete button

            var controls = document.createElement('div');
            controls.className = "item-control";
            var values = [0, 1, 2, 3, 4, 5];
            var quantitySelect = createQuantitySelect(count, values, 100, true, function (number) {
              if (number === 0) {
                deleteItem(product_ID);
                cartList.removeChild(article);
                renderShoppingCart();
              } else {
                setItem(product_ID, number);
                renderShoppingCart();
              }
            });
            var deleteButton = document.createElement('button');
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
            var price = document.createElement('span');
            price.textContent = (item.price * count).toFixed(2).replace(".", ",");
            flexContainer.appendChild(controls);
            flexContainer.appendChild(price);
            if (image) article.appendChild(figure);
            article.appendChild(title);
            article.appendChild(description);
            article.appendChild(flexContainer);
            cartList.appendChild(article);
          });
        }
      };

      http.send(params);
    } else {
      renderEmptyShoppingCart();
    }
  }
}

function renderEmptyShoppingCart() {
  var buyButton = document.getElementById("buy-button");
  buyButton.remove();
  var cartList = document.getElementById('cart-list');
  var info = document.createElement("p");
  info.textContent = "Dein Warenkorb ist leer!";
  cartList.appendChild(info);
}
/******/ })()
;