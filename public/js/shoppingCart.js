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

window.setItem = function (id) {
  var number = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 1;
  var additional = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 1;
  var xhr = new XMLHttpRequest();
  xhr.open("POST", '/api/cart/set', true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      console.log(xhr.responseText);
    }
  };

  xhr.send("id=".concat(id, "&number=").concat(number, "&additional=").concat(additional));
};
/******/ })()
;