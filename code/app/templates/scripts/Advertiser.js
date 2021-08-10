!function(e){var t={};function n(r){if(t[r])return t[r].exports;var o=t[r]={i:r,l:!1,exports:{}};return e[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)n.d(r,o,function(t){return e[t]}.bind(null,o));return r},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=0)}([function(e,t,n){"use strict";function r(e){return function(e){if(Array.isArray(e))return o(e)}(e)||function(e){if("undefined"!=typeof Symbol&&null!=e[Symbol.iterator]||null!=e["@@iterator"])return Array.from(e)}(e)||function(e,t){if(!e)return;if("string"==typeof e)return o(e,t);var n=Object.prototype.toString.call(e).slice(8,-1);"Object"===n&&e.constructor&&(n=e.constructor.name);if("Map"===n||"Set"===n)return Array.from(e);if("Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n))return o(e,t)}(e)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function o(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,r=new Array(t);n<t;n++)r[n]=e[n];return r}function a(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function i(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}function u(e,t,n){return t&&i(e.prototype,t),n&&i(e,n),e}n.r(t);var c=document.querySelector(".header__message"),s=document.querySelector(".content"),d=s.querySelector(".content__menu"),f=s.querySelector(".content__page");function l(e){e&&(c.textContent=e)}window.history.replaceState&&window.history.replaceState(null,null,window.location.href),s.addEventListener("click",(function(e){e.target.classList.contains("menu__cap")?d.classList.add("content__menu_open"):d.classList.remove("content__menu_open")})),c.addEventListener("animationend",(function(){c.textContent=""}));var v=function(){function e(t){var n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"/";a(this,e),this.ajax=new XMLHttpRequest,this.ajax.open(t,n),this.ajax.setRequestHeader("X-Requested-With","XMLHttpRequest")}return u(e,[{key:"send",value:function(){var e=this,t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;return new Promise((function(n,r){e.ajax.send(t),e.ajax.onreadystatechange=function(){4===e.ajax.readyState&&(200===e.ajax.status?e.ajax.responseText?n(JSON.parse(e.ajax.responseText)):n(!0):r(e.ajax))}}))}}]),e}(),m=function(){function e(){a(this,e)}return u(e,[{key:"render",value:function(e){var t=arguments.length>1&&void 0!==arguments[1]&&arguments[1];if(t){var n=document.createElement("div");n.className="content__animate",n.addEventListener("animationend",(function(){return n.remove()})),s.appendChild(n)}for(;f.firstChild;)f.removeChild(f.lastChild);f.innerHTML=e}},{key:"scripts",value:function(e){function t(e){"function"==typeof e&&e()}Array.isArray(e)?e.forEach((function(e){t(e)})):t(e)}}]),e}(),y=function(){function e(){a(this,e)}return u(e,null,[{key:"prepareToAjax",value:function(e){r(f.querySelectorAll('form[method="POST"]')).forEach((function(t){t.addEventListener("submit",(function(n){n.preventDefault(),new v("POST").send(new FormData(t)).then((function(t){t.message&&l(t.message),e()}))}))}))}}]),e}();function p(){var e,t,n,r=document.querySelector(".advertiser-offers__enable"),o=document.querySelector(".advertiser-offers__disable"),a=document.querySelector("#csrf").value;function i(t){var n=new FormData;n.append("route",t),n.append("id",e),n.append("csrf",a),new v("POST").send(n).then((function(e){e.message&&l(e.message),b(!1)}))}"ondragover"in document&&(r.addEventListener("dragover",(function(e){e.preventDefault()})),o.addEventListener("dragover",(function(e){e.preventDefault()})),r.addEventListener("drop",(function(){i("advertiser/offers/enable")})),o.addEventListener("drop",(function(){i("advertiser/offers/disable")})),document.querySelectorAll(".list__offer").forEach((function(t){t.addEventListener("dragstart",(function(){e=t.querySelector("#offerId").value}))}))),"ontouchstart"in document&&(document.querySelectorAll(".list__offer").forEach((function(r){r.addEventListener("touchstart",(function(o){e=r.querySelector("#offerId").value,t=o.changedTouches[0].clientX,n=o.changedTouches[0].clientY}))})),r.addEventListener("touchend",(function(r){var o=r.changedTouches[0].clientX,a=r.changedTouches[0].clientY;null!==e&&o-t>30&&Math.abs(n-a)<=30&&(i("advertiser/offers/disable"),e=null)})),o.addEventListener("touchend",(function(r){var o=r.changedTouches[0].clientX,a=r.changedTouches[0].clientY;null!==e&&o-t>30&&Math.abs(n-a)<=30&&(i("advertiser/offers/enable"),e=null)})))}function h(){var e=document.querySelector(".image__button"),t=document.querySelector(".label__filename");e.addEventListener("change",(function(){var n=e.files[0].name;t.textContent=n}))}function _(){var e=document.querySelector(".advertiser-stats__form"),t=e.querySelector("#datefrom"),n=e.querySelector("#dateto"),r=e.querySelector(".advertiser-stats__output"),o=e.querySelector(".advertiser-stats__offer-name"),a=e.querySelector("#redirects"),i=e.querySelector("#costs");e.addEventListener("submit",(function(u){u.preventDefault(),new v("POST").send(new FormData(e)).then((function(e){r.classList.add("advertiser-stats__output_show"),l(e.message),o.textContent=e.name,t.value=e.datefrom,n.value=e.dateto,a.textContent=e.redirects,i.textContent="".concat(e.costs)}))}))}function b(){var e=new v("GET","/advertiser/myoffers");e.send().then((function(e){var t=new m;t.render(e.body),t.scripts(p)}))}var S=document.querySelector(".advertiser-menu__offers"),g=document.querySelector(".advertiser-menu__new"),w=document.querySelector(".advertiser-menu__statistic");S.addEventListener("click",(function(){b()})),g.addEventListener("click",(function(){new v("GET","/advertiser/newoffer").send().then((function(e){var t=new m;t.render(e.body),t.scripts(h),y.prepareToAjax(b)}))})),w.addEventListener("click",(function(){new v("GET","/advertiser/stats").send().then((function(e){var t=new m;t.render(e.body),t.scripts(_)}))}))}]);