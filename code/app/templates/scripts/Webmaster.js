!function(e){var t={};function n(r){if(t[r])return t[r].exports;var o=t[r]={i:r,l:!1,exports:{}};return e[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)n.d(r,o,function(t){return e[t]}.bind(null,o));return r},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=0)}([function(e,t,n){"use strict";function r(e){return function(e){if(Array.isArray(e))return o(e)}(e)||function(e){if("undefined"!=typeof Symbol&&null!=e[Symbol.iterator]||null!=e["@@iterator"])return Array.from(e)}(e)||function(e,t){if(!e)return;if("string"==typeof e)return o(e,t);var n=Object.prototype.toString.call(e).slice(8,-1);"Object"===n&&e.constructor&&(n=e.constructor.name);if("Map"===n||"Set"===n)return Array.from(e);if("Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n))return o(e,t)}(e)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function o(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,r=new Array(t);n<t;n++)r[n]=e[n];return r}function a(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function i(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}function u(e,t,n){return t&&i(e.prototype,t),n&&i(e,n),e}n.r(t);var c=document.querySelector(".header__message"),s=document.querySelector(".content"),l=s.querySelector(".content__menu"),f=s.querySelector(".content__page");function d(e){e&&(c.textContent=e)}window.history.replaceState&&window.history.replaceState(null,null,window.location.href),s.addEventListener("click",(function(e){e.target.classList.contains("menu__cap")?l.classList.add("content__menu_open"):l.classList.remove("content__menu_open")})),c.addEventListener("animationend",(function(){c.textContent=""}));var m=function(){function e(t){var n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"/";a(this,e),this.ajax=new XMLHttpRequest,this.ajax.open(t,n),this.ajax.setRequestHeader("X-Requested-With","XMLHttpRequest")}return u(e,[{key:"send",value:function(){var e=this,t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return new Promise((function(n,r){e.ajax.send(t),e.ajax.onreadystatechange=function(){4===e.ajax.readyState&&(200===e.ajax.status?e.ajax.responseText?n(JSON.parse(e.ajax.responseText)):n(!0):r(e.ajax))}}))}}]),e}(),p=function(){function e(){a(this,e)}return u(e,[{key:"render",value:function(e){var t=arguments.length>1&&void 0!==arguments[1]&&arguments[1];if(t){var n=document.createElement("div");n.className="content__animate",n.addEventListener("animationend",(function(){return n.remove()})),s.appendChild(n)}for(;f.firstChild;)f.removeChild(f.lastChild);f.innerHTML=e}},{key:"scripts",value:function(e){function t(e){"function"==typeof e&&e()}Array.isArray(e)?e.forEach((function(e){t(e)})):t(e)}}]),e}(),y=function(){function e(){a(this,e)}return u(e,null,[{key:"prepareToAjax",value:function(e){r(f.querySelectorAll('form[method="POST"]')).forEach((function(t){t.addEventListener("submit",(function(n){n.preventDefault(),new m("POST").send(new FormData(t)).then((function(t){t.message&&d(t.message),e()}))}))}))}}]),e}();function b(){var e=document.querySelector(".webmaster-stats__form"),t=e.querySelector("#datefrom"),n=e.querySelector("#dateto"),r=e.querySelector(".webmaster-stats__output"),o=e.querySelector(".webmaster-stats__offer-name"),a=e.querySelector("#redirects"),i=e.querySelector("#costs");e.addEventListener("submit",(function(u){u.preventDefault(),new m("POST").send(new FormData(e)).then((function(e){r.classList.add("webmaster-stats__output_show"),d(e.message),o.textContent=e.name,t.value=e.datefrom,n.value=e.dateto,a.textContent=e.redirects,i.textContent="".concat(e.costs)}))}))}function v(){var e=arguments.length>0&&void 0!==arguments[0]&&arguments[0],t=new m("GET","/webmaster/subscriptions");t.send().then((function(t){(new p).render(t.body,e),y.prepareToAjax(v)}))}var h=document.querySelector(".webmaster-menu__subscriptions"),w=document.querySelector(".webmaster-menu__subscribe"),_=document.querySelector(".webmaster-menu__stats");h.addEventListener("click",(function(){v(!0)})),w.addEventListener("click",(function(){!function e(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"/webmaster/subscribe",n=arguments.length>1&&void 0!==arguments[1]&&arguments[1],r=new m("GET",t);r.send().then((function(t){(new p).render(t.body,n);var r=document.querySelector(".webmaster-subscribe__tematics");r&&r.addEventListener("submit",(function(t){t.preventDefault();var n=new URLSearchParams,o=new FormData(r);o.has("tematic")&&n.append("tematic",o.get("tematic")),e("/webmaster/subscribe?".concat(n.toString()),!1)})),y.prepareToAjax()}))}("/webmaster/subscribe",!0)})),_.addEventListener("click",(function(){!function(){var e=arguments.length>0&&void 0!==arguments[0]&&arguments[0],t=new m("GET","/webmaster/stats");t.send().then((function(t){var n=new p;n.render(t.body,e),n.scripts(b)}))}(!0)}))}]);