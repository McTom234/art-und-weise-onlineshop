/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!****************************************!*\
  !*** ./resources/js/quantitySelect.ts ***!
  \****************************************/


function createQuantitySelect(defaultValue, values, maxValue, isLastExtends, onSelect) {
  document.addEventListener("click", closeAllQuantitySelects);
  var quantitySelect = document.createElement("div");
  quantitySelect.className = "quantity-select";
  var quantityInput;
  var defaultElement = document.createElement("div");
  defaultElement.className = "select-selected";
  defaultElement.textContent = "Menge: " + defaultValue;
  quantitySelect.append(defaultElement);
  var dropdown = document.createElement("div");
  dropdown.className = "select-items select-hide";

  var _loop = function _loop(i) {
    if (values[i] === 0) return "continue";
    var element = document.createElement("div");

    if (isLastExtends && i >= values.length - 1) {
      element.textContent = values[i] + "+";
      element.addEventListener('click', function () {
        defaultElement.classList.toggle("hide");
        quantityInput.classList.toggle("hide");
      });
      dropdown.append(element);
      return "continue";
    }

    element.textContent = values[i].toString();
    element.addEventListener('click', function () {
      onSelect(values[i]);
      defaultElement.textContent = "Menge: " + this.textContent;
      var selectedElements = dropdown.getElementsByClassName("same-as-selected");

      for (var k = 0; k < selectedElements.length; k++) {
        selectedElements[k].removeAttribute("class");
      }

      this.className = "same-as-selected";
      closeAllQuantitySelects();
    });
    dropdown.append(element);
  };

  for (var i = 0; i < values.length; i++) {
    var _ret = _loop(i);

    if (_ret === "continue") continue;
  }

  quantitySelect.append(dropdown);
  defaultElement.addEventListener("click", function (e) {
    e.stopPropagation();
    dropdown.classList.toggle("select-hide");
    this.classList.toggle("select-arrow-active");
  });

  if (isLastExtends) {
    var submit = function submit() {
      if (Number(input.value) < inputStartValue) {
        onSelect(Number(input.value));
        defaultElement.classList.toggle("hide");
        quantityInput.classList.toggle("hide");
        defaultElement.textContent = "Menge: " + input.value;
        var elements = dropdown.children;

        for (var _i = 0; _i < elements.length; _i++) {
          if (input.value === elements[_i].textContent) {
            elements[_i].className = "same-as-selected";
          } else {
            elements[_i].removeAttribute("class");
          }
        }

        input.value = inputStartValue.toString();
      } else {
        onSelect(parseInt(input.value, 10));
        button.className = "hide";
        input.blur();
      }
    };

    quantityInput = document.createElement("div");
    var inputStartValue = values[values.length - 1];
    var input = document.createElement("input");
    input.type = "number";
    input.min = "0";
    input.max = maxValue.toString();
    input.value = inputStartValue.toString();
    var button = document.createElement("button");
    button.textContent = "Aktualisieren";
    input.addEventListener("keyup", function (event) {
      if (event.key === "Enter") {
        submit();
      }
    });
    input.addEventListener("input", function () {
      button.removeAttribute("class");

      if (Number(input.value) > maxValue) {
        input.value = maxValue.toString();
      }

      if (Number(input.value) < 0) {
        input.value = '';
      }
    });

    if (defaultValue >= inputStartValue) {
      quantityInput.className = "quantity-input";
      defaultElement.classList.toggle("hide");
      button.className = "hide";
      input.value = defaultValue.toString();
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

window.createQuantitySelect = createQuantitySelect;

function closeAllQuantitySelects() {
  var selectItems = document.getElementsByClassName("select-items");
  var selectSelected = document.getElementsByClassName("select-selected");

  for (var i = 0; i < selectSelected.length; i++) {
    selectSelected[i].classList.remove("select-arrow-active");
  }

  for (var _i2 = 0; _i2 < selectItems.length; _i2++) {
    selectItems[_i2].classList.add("select-hide");
  }
}
/******/ })()
;