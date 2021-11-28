/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/products.js ***!
  \**********************************/
var row = 0;

function fetchProducts(number) {
  var http = new XMLHttpRequest();
  var url = './fetchProducts';
  var params = "row=".concat(row, "&number=").concat(number);
  http.open('POST', url, true);
  http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

  http.onreadystatechange = function () {
    if (http.readyState === 4 && http.status === 200) {
      var productsList = document.getElementById('productsList');
      productsList.innerHTML += http.responseText;
    }
  };

  http.send(params);
  row += number;
}

for (var i = 0; i < 3; i++) {// fetchProducts(3);
}

$(window).scroll(function () {
  if ($(window).scrollTop() > $(document).height() - $(window).height() * 2) {
    for (var _i = 0; _i < 3; _i++) {//fetchProducts(3);
    }
  }
});
/******/ })()
;