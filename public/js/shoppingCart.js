/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!**************************************!*\
  !*** ./resources/js/shoppingCart.ts ***!
  \**************************************/


function setItem(product_id) {
  var product_count = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 1;
  var additional = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;
  return axios.post('/api/cart/set', {
    id: product_id,
    number: product_count,
    additional: additional
  });
}

window.setItem = setItem;
/******/ })()
;