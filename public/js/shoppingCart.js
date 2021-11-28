/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************!*\
  !*** ./resources/js/shoppingCart.js ***!
  \**************************************/
window.deleteItem = function (id) {
  var shoppingCart = getCookies('shoppingCart');

  if (shoppingCart === null) {
    return;
  }

  delete shoppingCart[id];
  setCookies('shoppingCart', shoppingCart);
};

window.addItem = function (id) {
  var number = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 1;
  var shoppingCart = getCookies('shoppingCart');

  if (!shoppingCart) {
    shoppingCart = {};
  }

  if (shoppingCart[id]) {
    shoppingCart[id] += number;
  } else {
    shoppingCart[id] = number;
  }

  setCookies('shoppingCart', shoppingCart);
};

window.setItem = function (id, count) {
  var shoppingCart = getCookies('shoppingCart');

  if (shoppingCart === null) {
    shoppingCart = {};
  }

  shoppingCart[id] = count;
  setCookies('shoppingCart', shoppingCart);
};

window.getShoppingCart = function () {
  return getCookies('shoppingCart');
};
/******/ })()
;