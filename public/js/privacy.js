/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/privacy.ts ***!
  \*********************************/


function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

var Privacy = /*#__PURE__*/function () {
  function Privacy() {
    _classCallCheck(this, Privacy);
  }

  _createClass(Privacy, [{
    key: "accept",
    value: function accept() {
      var expire = new Date();
      expire.setTime(expire.getTime() + 2592000000);
      document.cookie = 'privacyClaimer=' + expire.getTime() + '; expires=' + expire.toUTCString() + '; path=/;';
      this.closeHint();
    }
  }, {
    key: "check",
    value: function check() {
      var cName = "privacyClaimer=";
      var cArray = decodeURIComponent(document.cookie).split(';');

      for (var i = 0; i < cArray.length; i++) {
        var c = cArray[i];

        while (c.charAt(0) === ' ') {
          c = c.substring(1);
        }

        if (c.indexOf(cName) === 0) {
          try {
            var oldExpire = new Date(Number(c.substring(cName.length, c.length)));
            if (oldExpire.getTime() >= new Date().getTime()) return true;
          } catch (e) {}
        }
      }

      return false;
    }
  }, {
    key: "printHint",
    value: function printHint() {
      var hint = document.getElementById('cookie-privacy-claimer');
      hint.classList.add('visible');
    }
  }, {
    key: "closeHint",
    value: function closeHint() {
      var hint = document.getElementById('cookie-privacy-claimer');
      hint.classList.remove('visible');
    }
  }]);

  return Privacy;
}();

window.privacy = new Privacy();
if (!privacy.check()) privacy.printHint();
/******/ })()
;