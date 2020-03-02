/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/bundles/agrigestion/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./assets/js/main.js":
/*!***************************!*\
  !*** ./assets/js/main.js ***!
  \***************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _ribsApi = __webpack_require__(/*! ribs-api */ "./node_modules/ribs-api/RibsApi.js");

var _ribsApi2 = _interopRequireDefault(_ribsApi);

function _interopRequireDefault(obj) {
  return obj && obj.__esModule ? obj : { default: obj };
}

var api = new _ribsApi2.default('');
var ribsForms = document.querySelectorAll('form.ribs-form');

ribsForms.forEach(function (form) {
  var autocompleteFields = form.querySelectorAll('.input-autocomplete');

  autocompleteFields.forEach(function (autocompleteField) {
    autocompleteField.addEventListener('keyup', function (event) {
      var field = event.currentTarget;
      console.log(window.origin);
      console.log(field.dataset.url);
      if (field.value.length > 2) {
        api.post(field.dataset.url, { autocomplete: field.value }).then(function (data) {
          console.log(data);
        });
      }
    });
  });
});

/***/ }),

/***/ "./node_modules/ribs-api/RibsApi.js":
/*!******************************************!*\
  !*** ./node_modules/ribs-api/RibsApi.js ***!
  \******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
class RibsApi {
  /**
   * @param baseUrl string that contains the base url with the slash of end that will be called
   * @param mode getting mode of the url, cors, no-cors, ...
   * @param credentials of the url like same-origin
   */
  constructor(baseUrl, mode, credentials) {
    let startUrl = `${window.location.protocol}//${window.location.hostname}/`;

    if (!window.origin && mode !== 'cors') {
      startUrl = `${window.location.protocol}//${window.location.hostname}${(window.location.port ? `:${window.location.port}` : '')}`;
    }

    this.baseUrl = `${startUrl}${baseUrl}`;
    this.mode = mode;
    this.credentials = credentials;
  }

  /**
   * method to get a url by get method
   * @param url
   * @param format
   * @returns {Promise<Response>}
   */
  get(url, format = 'json') {
    return this.execRequest('GET', url, format);
  }

  /**
   * method to send a request with post method to a url with datas
   * datas can be a form data or an object that will be transform to a FormData object
   * @param url
   * @param data
   * @param format
   * @returns {*}
   */
  post(url, data, format = 'json') {
    let formData;

    if (!(data instanceof FormData)) {
      formData = new FormData();

      for (const tempData in data) {
        formData.append(tempData, data[tempData]);
      }
    } else {
      formData = data;
    }

    return this.execRequest('POST', url, format, formData);
  }

  /**
   * method that send all types of request to a given url
   * @param method
   * @param url
   * @param format
   * @param body
   * @returns {Promise<Response>}
   */
  execRequest(method, url, format, body = null) {
    let postUrl = url;

    if (url[0] === '/') {
      postUrl = url.substr(1);
    }

    const request = new Request(`${this.baseUrl}${postUrl}`, {
      method,
      mode: this.mode,
      body,
      credentials: this.credentials,
    });

    return fetch(request)
      .then((response) => {
        if (response.status !== 200) {
          return 'error';
        }

        if (format === 'json') {
          return response.json();
        }

        return response.text();
      })
      .then((responseValue) => {
        if (format === 'html') {
          const parser = new DOMParser();
          const parsedDocument = parser.parseFromString(responseValue, "text/html");

          this.deleteScriptTagDom();
          this.insertScriptTagInDom(parsedDocument);
        }

          return responseValue;
      });
  }

  /**
   * method to delete script tags in parent document
   */
  deleteScriptTagDom() {
    document.querySelectorAll('script[data-ribsajaxscript]').forEach((element) => {
      document.body.removeChild(element);
    });
  }

  /**
   * method to insert script tags in parent document
   * @param parsedDocument
   */
  insertScriptTagInDom(parsedDocument) {
      parsedDocument.querySelectorAll('script').forEach((element) => {
        const script = parsedDocument.createElement("script");
        script.src = element.src;
        script.dataset.ribsajaxscript = '';
        document.body.appendChild(script);
      });
  }
}

/* harmony default export */ __webpack_exports__["default"] = (RibsApi);


/***/ }),

/***/ 0:
/*!*********************************!*\
  !*** multi ./assets/js/main.js ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! ./assets/js/main.js */"./assets/js/main.js");


/***/ })

/******/ });
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vd2VicGFjay9ib290c3RyYXAiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL21haW4uanMiLCJ3ZWJwYWNrOi8vLy4vbm9kZV9tb2R1bGVzL3JpYnMtYXBpL1JpYnNBcGkuanMiXSwibmFtZXMiOlsiYXBpIiwiUmlic0FwaSIsInJpYnNGb3JtcyIsImRvY3VtZW50IiwiYXV0b2NvbXBsZXRlRmllbGRzIiwiZm9ybSIsImF1dG9jb21wbGV0ZUZpZWxkIiwiZmllbGQiLCJldmVudCIsImNvbnNvbGUiLCJ3aW5kb3ciLCJhdXRvY29tcGxldGUiXSwibWFwcGluZ3MiOiI7UUFBQTtRQUNBOztRQUVBO1FBQ0E7O1FBRUE7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7O1FBRUE7UUFDQTs7UUFFQTtRQUNBOztRQUVBO1FBQ0E7UUFDQTs7O1FBR0E7UUFDQTs7UUFFQTtRQUNBOztRQUVBO1FBQ0E7UUFDQTtRQUNBLDBDQUEwQyxnQ0FBZ0M7UUFDMUU7UUFDQTs7UUFFQTtRQUNBO1FBQ0E7UUFDQSx3REFBd0Qsa0JBQWtCO1FBQzFFO1FBQ0EsaURBQWlELGNBQWM7UUFDL0Q7O1FBRUE7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBLHlDQUF5QyxpQ0FBaUM7UUFDMUUsZ0hBQWdILG1CQUFtQixFQUFFO1FBQ3JJO1FBQ0E7O1FBRUE7UUFDQTtRQUNBO1FBQ0EsMkJBQTJCLDBCQUEwQixFQUFFO1FBQ3ZELGlDQUFpQyxlQUFlO1FBQ2hEO1FBQ0E7UUFDQTs7UUFFQTtRQUNBLHNEQUFzRCwrREFBK0Q7O1FBRXJIO1FBQ0E7OztRQUdBO1FBQ0E7Ozs7Ozs7Ozs7Ozs7OztBQ2xGQTs7Ozs7Ozs7QUFFQSxJQUFNQSxNQUFNLElBQUlDLFVBQUosUUFBWixFQUFZLENBQVo7QUFDQSxJQUFNQyxZQUFZQywwQkFBbEIsZ0JBQWtCQSxDQUFsQjs7QUFFQUQsa0JBQWtCLGdCQUFVO0FBQzFCLE1BQU1FLHFCQUFxQkMsc0JBQTNCLHFCQUEyQkEsQ0FBM0I7O0FBRUFELDZCQUEyQiw2QkFBdUI7QUFDaERFLGdEQUE0QyxpQkFBVztBQUNyRCxVQUFNQyxRQUFRQyxNQUFkO0FBQ0FDLGtCQUFZQyxPQUFaRDtBQUNBQSxrQkFBWUYsY0FBWkU7QUFDQSxVQUFJRixxQkFBSixHQUE0QjtBQUMxQlAsaUJBQVNPLGNBQVRQLEtBQTRCLEVBQUNXLGNBQWNKLE1BQTNDUCxLQUE0QixFQUE1QkEsT0FBOEQsZ0JBQVU7QUFDdEVTO0FBREZUO0FBR0Q7QUFSSE07QUFERkY7QUFIRkYsRzs7Ozs7Ozs7Ozs7O0FDTEE7QUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBLHNCQUFzQix5QkFBeUIsSUFBSSx5QkFBeUI7O0FBRTVFO0FBQ0Esb0JBQW9CLHlCQUF5QixJQUFJLHlCQUF5QixFQUFFLDRCQUE0QixxQkFBcUIsUUFBUTtBQUNySTs7QUFFQSxzQkFBc0IsU0FBUyxFQUFFLFFBQVE7QUFDekM7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsZUFBZTtBQUNmO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBLGVBQWU7QUFDZjtBQUNBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQSxLQUFLO0FBQ0w7QUFDQTs7QUFFQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBLGVBQWU7QUFDZjtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBOztBQUVBLG1DQUFtQyxhQUFhLEVBQUUsUUFBUTtBQUMxRDtBQUNBO0FBQ0E7QUFDQTtBQUNBLEtBQUs7O0FBRUw7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQSxPQUFPO0FBQ1A7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBOztBQUVBO0FBQ0EsT0FBTztBQUNQOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBLEtBQUs7QUFDTDs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBLE9BQU87QUFDUDtBQUNBOztBQUVlLHNFQUFPLEVBQUMiLCJmaWxlIjoianMvbWFpbi5qcyIsInNvdXJjZXNDb250ZW50IjpbIiBcdC8vIFRoZSBtb2R1bGUgY2FjaGVcbiBcdHZhciBpbnN0YWxsZWRNb2R1bGVzID0ge307XG5cbiBcdC8vIFRoZSByZXF1aXJlIGZ1bmN0aW9uXG4gXHRmdW5jdGlvbiBfX3dlYnBhY2tfcmVxdWlyZV9fKG1vZHVsZUlkKSB7XG5cbiBcdFx0Ly8gQ2hlY2sgaWYgbW9kdWxlIGlzIGluIGNhY2hlXG4gXHRcdGlmKGluc3RhbGxlZE1vZHVsZXNbbW9kdWxlSWRdKSB7XG4gXHRcdFx0cmV0dXJuIGluc3RhbGxlZE1vZHVsZXNbbW9kdWxlSWRdLmV4cG9ydHM7XG4gXHRcdH1cbiBcdFx0Ly8gQ3JlYXRlIGEgbmV3IG1vZHVsZSAoYW5kIHB1dCBpdCBpbnRvIHRoZSBjYWNoZSlcbiBcdFx0dmFyIG1vZHVsZSA9IGluc3RhbGxlZE1vZHVsZXNbbW9kdWxlSWRdID0ge1xuIFx0XHRcdGk6IG1vZHVsZUlkLFxuIFx0XHRcdGw6IGZhbHNlLFxuIFx0XHRcdGV4cG9ydHM6IHt9XG4gXHRcdH07XG5cbiBcdFx0Ly8gRXhlY3V0ZSB0aGUgbW9kdWxlIGZ1bmN0aW9uXG4gXHRcdG1vZHVsZXNbbW9kdWxlSWRdLmNhbGwobW9kdWxlLmV4cG9ydHMsIG1vZHVsZSwgbW9kdWxlLmV4cG9ydHMsIF9fd2VicGFja19yZXF1aXJlX18pO1xuXG4gXHRcdC8vIEZsYWcgdGhlIG1vZHVsZSBhcyBsb2FkZWRcbiBcdFx0bW9kdWxlLmwgPSB0cnVlO1xuXG4gXHRcdC8vIFJldHVybiB0aGUgZXhwb3J0cyBvZiB0aGUgbW9kdWxlXG4gXHRcdHJldHVybiBtb2R1bGUuZXhwb3J0cztcbiBcdH1cblxuXG4gXHQvLyBleHBvc2UgdGhlIG1vZHVsZXMgb2JqZWN0IChfX3dlYnBhY2tfbW9kdWxlc19fKVxuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5tID0gbW9kdWxlcztcblxuIFx0Ly8gZXhwb3NlIHRoZSBtb2R1bGUgY2FjaGVcbiBcdF9fd2VicGFja19yZXF1aXJlX18uYyA9IGluc3RhbGxlZE1vZHVsZXM7XG5cbiBcdC8vIGRlZmluZSBnZXR0ZXIgZnVuY3Rpb24gZm9yIGhhcm1vbnkgZXhwb3J0c1xuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5kID0gZnVuY3Rpb24oZXhwb3J0cywgbmFtZSwgZ2V0dGVyKSB7XG4gXHRcdGlmKCFfX3dlYnBhY2tfcmVxdWlyZV9fLm8oZXhwb3J0cywgbmFtZSkpIHtcbiBcdFx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywgbmFtZSwgeyBlbnVtZXJhYmxlOiB0cnVlLCBnZXQ6IGdldHRlciB9KTtcbiBcdFx0fVxuIFx0fTtcblxuIFx0Ly8gZGVmaW5lIF9fZXNNb2R1bGUgb24gZXhwb3J0c1xuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5yID0gZnVuY3Rpb24oZXhwb3J0cykge1xuIFx0XHRpZih0eXBlb2YgU3ltYm9sICE9PSAndW5kZWZpbmVkJyAmJiBTeW1ib2wudG9TdHJpbmdUYWcpIHtcbiBcdFx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywgU3ltYm9sLnRvU3RyaW5nVGFnLCB7IHZhbHVlOiAnTW9kdWxlJyB9KTtcbiBcdFx0fVxuIFx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywgJ19fZXNNb2R1bGUnLCB7IHZhbHVlOiB0cnVlIH0pO1xuIFx0fTtcblxuIFx0Ly8gY3JlYXRlIGEgZmFrZSBuYW1lc3BhY2Ugb2JqZWN0XG4gXHQvLyBtb2RlICYgMTogdmFsdWUgaXMgYSBtb2R1bGUgaWQsIHJlcXVpcmUgaXRcbiBcdC8vIG1vZGUgJiAyOiBtZXJnZSBhbGwgcHJvcGVydGllcyBvZiB2YWx1ZSBpbnRvIHRoZSBuc1xuIFx0Ly8gbW9kZSAmIDQ6IHJldHVybiB2YWx1ZSB3aGVuIGFscmVhZHkgbnMgb2JqZWN0XG4gXHQvLyBtb2RlICYgOHwxOiBiZWhhdmUgbGlrZSByZXF1aXJlXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLnQgPSBmdW5jdGlvbih2YWx1ZSwgbW9kZSkge1xuIFx0XHRpZihtb2RlICYgMSkgdmFsdWUgPSBfX3dlYnBhY2tfcmVxdWlyZV9fKHZhbHVlKTtcbiBcdFx0aWYobW9kZSAmIDgpIHJldHVybiB2YWx1ZTtcbiBcdFx0aWYoKG1vZGUgJiA0KSAmJiB0eXBlb2YgdmFsdWUgPT09ICdvYmplY3QnICYmIHZhbHVlICYmIHZhbHVlLl9fZXNNb2R1bGUpIHJldHVybiB2YWx1ZTtcbiBcdFx0dmFyIG5zID0gT2JqZWN0LmNyZWF0ZShudWxsKTtcbiBcdFx0X193ZWJwYWNrX3JlcXVpcmVfXy5yKG5zKTtcbiBcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KG5zLCAnZGVmYXVsdCcsIHsgZW51bWVyYWJsZTogdHJ1ZSwgdmFsdWU6IHZhbHVlIH0pO1xuIFx0XHRpZihtb2RlICYgMiAmJiB0eXBlb2YgdmFsdWUgIT0gJ3N0cmluZycpIGZvcih2YXIga2V5IGluIHZhbHVlKSBfX3dlYnBhY2tfcmVxdWlyZV9fLmQobnMsIGtleSwgZnVuY3Rpb24oa2V5KSB7IHJldHVybiB2YWx1ZVtrZXldOyB9LmJpbmQobnVsbCwga2V5KSk7XG4gXHRcdHJldHVybiBucztcbiBcdH07XG5cbiBcdC8vIGdldERlZmF1bHRFeHBvcnQgZnVuY3Rpb24gZm9yIGNvbXBhdGliaWxpdHkgd2l0aCBub24taGFybW9ueSBtb2R1bGVzXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLm4gPSBmdW5jdGlvbihtb2R1bGUpIHtcbiBcdFx0dmFyIGdldHRlciA9IG1vZHVsZSAmJiBtb2R1bGUuX19lc01vZHVsZSA/XG4gXHRcdFx0ZnVuY3Rpb24gZ2V0RGVmYXVsdCgpIHsgcmV0dXJuIG1vZHVsZVsnZGVmYXVsdCddOyB9IDpcbiBcdFx0XHRmdW5jdGlvbiBnZXRNb2R1bGVFeHBvcnRzKCkgeyByZXR1cm4gbW9kdWxlOyB9O1xuIFx0XHRfX3dlYnBhY2tfcmVxdWlyZV9fLmQoZ2V0dGVyLCAnYScsIGdldHRlcik7XG4gXHRcdHJldHVybiBnZXR0ZXI7XG4gXHR9O1xuXG4gXHQvLyBPYmplY3QucHJvdG90eXBlLmhhc093blByb3BlcnR5LmNhbGxcbiBcdF9fd2VicGFja19yZXF1aXJlX18ubyA9IGZ1bmN0aW9uKG9iamVjdCwgcHJvcGVydHkpIHsgcmV0dXJuIE9iamVjdC5wcm90b3R5cGUuaGFzT3duUHJvcGVydHkuY2FsbChvYmplY3QsIHByb3BlcnR5KTsgfTtcblxuIFx0Ly8gX193ZWJwYWNrX3B1YmxpY19wYXRoX19cbiBcdF9fd2VicGFja19yZXF1aXJlX18ucCA9IFwiL2J1bmRsZXMvYWdyaWdlc3Rpb24vXCI7XG5cblxuIFx0Ly8gTG9hZCBlbnRyeSBtb2R1bGUgYW5kIHJldHVybiBleHBvcnRzXG4gXHRyZXR1cm4gX193ZWJwYWNrX3JlcXVpcmVfXyhfX3dlYnBhY2tfcmVxdWlyZV9fLnMgPSAwKTtcbiIsImltcG9ydCBSaWJzQXBpIGZyb20gXCJyaWJzLWFwaVwiO1xuXG5jb25zdCBhcGkgPSBuZXcgUmlic0FwaSgnJyk7XG5jb25zdCByaWJzRm9ybXMgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCdmb3JtLnJpYnMtZm9ybScpO1xuXG5yaWJzRm9ybXMuZm9yRWFjaCgoZm9ybSkgPT4ge1xuICBjb25zdCBhdXRvY29tcGxldGVGaWVsZHMgPSBmb3JtLnF1ZXJ5U2VsZWN0b3JBbGwoJy5pbnB1dC1hdXRvY29tcGxldGUnKTtcblxuICBhdXRvY29tcGxldGVGaWVsZHMuZm9yRWFjaCgoYXV0b2NvbXBsZXRlRmllbGQpID0+IHtcbiAgICBhdXRvY29tcGxldGVGaWVsZC5hZGRFdmVudExpc3RlbmVyKCdrZXl1cCcsIChldmVudCkgPT4ge1xuICAgICAgY29uc3QgZmllbGQgPSBldmVudC5jdXJyZW50VGFyZ2V0O1xuICAgICAgY29uc29sZS5sb2cod2luZG93Lm9yaWdpbik7XG4gICAgICBjb25zb2xlLmxvZyhmaWVsZC5kYXRhc2V0LnVybCk7XG4gICAgICBpZiAoZmllbGQudmFsdWUubGVuZ3RoID4gMikge1xuICAgICAgICBhcGkucG9zdChmaWVsZC5kYXRhc2V0LnVybCwge2F1dG9jb21wbGV0ZTogZmllbGQudmFsdWV9KS50aGVuKChkYXRhKSA9PiB7XG4gICAgICAgICAgY29uc29sZS5sb2coZGF0YSk7XG4gICAgICAgIH0pO1xuICAgICAgfVxuICAgIH0pO1xuICB9KTtcbn0pO1xuIiwiY2xhc3MgUmlic0FwaSB7XG4gIC8qKlxuICAgKiBAcGFyYW0gYmFzZVVybCBzdHJpbmcgdGhhdCBjb250YWlucyB0aGUgYmFzZSB1cmwgd2l0aCB0aGUgc2xhc2ggb2YgZW5kIHRoYXQgd2lsbCBiZSBjYWxsZWRcbiAgICogQHBhcmFtIG1vZGUgZ2V0dGluZyBtb2RlIG9mIHRoZSB1cmwsIGNvcnMsIG5vLWNvcnMsIC4uLlxuICAgKiBAcGFyYW0gY3JlZGVudGlhbHMgb2YgdGhlIHVybCBsaWtlIHNhbWUtb3JpZ2luXG4gICAqL1xuICBjb25zdHJ1Y3RvcihiYXNlVXJsLCBtb2RlLCBjcmVkZW50aWFscykge1xuICAgIGxldCBzdGFydFVybCA9IGAke3dpbmRvdy5sb2NhdGlvbi5wcm90b2NvbH0vLyR7d2luZG93LmxvY2F0aW9uLmhvc3RuYW1lfS9gO1xuXG4gICAgaWYgKCF3aW5kb3cub3JpZ2luICYmIG1vZGUgIT09ICdjb3JzJykge1xuICAgICAgc3RhcnRVcmwgPSBgJHt3aW5kb3cubG9jYXRpb24ucHJvdG9jb2x9Ly8ke3dpbmRvdy5sb2NhdGlvbi5ob3N0bmFtZX0keyh3aW5kb3cubG9jYXRpb24ucG9ydCA/IGA6JHt3aW5kb3cubG9jYXRpb24ucG9ydH1gIDogJycpfWA7XG4gICAgfVxuXG4gICAgdGhpcy5iYXNlVXJsID0gYCR7c3RhcnRVcmx9JHtiYXNlVXJsfWA7XG4gICAgdGhpcy5tb2RlID0gbW9kZTtcbiAgICB0aGlzLmNyZWRlbnRpYWxzID0gY3JlZGVudGlhbHM7XG4gIH1cblxuICAvKipcbiAgICogbWV0aG9kIHRvIGdldCBhIHVybCBieSBnZXQgbWV0aG9kXG4gICAqIEBwYXJhbSB1cmxcbiAgICogQHBhcmFtIGZvcm1hdFxuICAgKiBAcmV0dXJucyB7UHJvbWlzZTxSZXNwb25zZT59XG4gICAqL1xuICBnZXQodXJsLCBmb3JtYXQgPSAnanNvbicpIHtcbiAgICByZXR1cm4gdGhpcy5leGVjUmVxdWVzdCgnR0VUJywgdXJsLCBmb3JtYXQpO1xuICB9XG5cbiAgLyoqXG4gICAqIG1ldGhvZCB0byBzZW5kIGEgcmVxdWVzdCB3aXRoIHBvc3QgbWV0aG9kIHRvIGEgdXJsIHdpdGggZGF0YXNcbiAgICogZGF0YXMgY2FuIGJlIGEgZm9ybSBkYXRhIG9yIGFuIG9iamVjdCB0aGF0IHdpbGwgYmUgdHJhbnNmb3JtIHRvIGEgRm9ybURhdGEgb2JqZWN0XG4gICAqIEBwYXJhbSB1cmxcbiAgICogQHBhcmFtIGRhdGFcbiAgICogQHBhcmFtIGZvcm1hdFxuICAgKiBAcmV0dXJucyB7Kn1cbiAgICovXG4gIHBvc3QodXJsLCBkYXRhLCBmb3JtYXQgPSAnanNvbicpIHtcbiAgICBsZXQgZm9ybURhdGE7XG5cbiAgICBpZiAoIShkYXRhIGluc3RhbmNlb2YgRm9ybURhdGEpKSB7XG4gICAgICBmb3JtRGF0YSA9IG5ldyBGb3JtRGF0YSgpO1xuXG4gICAgICBmb3IgKGNvbnN0IHRlbXBEYXRhIGluIGRhdGEpIHtcbiAgICAgICAgZm9ybURhdGEuYXBwZW5kKHRlbXBEYXRhLCBkYXRhW3RlbXBEYXRhXSk7XG4gICAgICB9XG4gICAgfSBlbHNlIHtcbiAgICAgIGZvcm1EYXRhID0gZGF0YTtcbiAgICB9XG5cbiAgICByZXR1cm4gdGhpcy5leGVjUmVxdWVzdCgnUE9TVCcsIHVybCwgZm9ybWF0LCBmb3JtRGF0YSk7XG4gIH1cblxuICAvKipcbiAgICogbWV0aG9kIHRoYXQgc2VuZCBhbGwgdHlwZXMgb2YgcmVxdWVzdCB0byBhIGdpdmVuIHVybFxuICAgKiBAcGFyYW0gbWV0aG9kXG4gICAqIEBwYXJhbSB1cmxcbiAgICogQHBhcmFtIGZvcm1hdFxuICAgKiBAcGFyYW0gYm9keVxuICAgKiBAcmV0dXJucyB7UHJvbWlzZTxSZXNwb25zZT59XG4gICAqL1xuICBleGVjUmVxdWVzdChtZXRob2QsIHVybCwgZm9ybWF0LCBib2R5ID0gbnVsbCkge1xuICAgIGxldCBwb3N0VXJsID0gdXJsO1xuXG4gICAgaWYgKHVybFswXSA9PT0gJy8nKSB7XG4gICAgICBwb3N0VXJsID0gdXJsLnN1YnN0cigxKTtcbiAgICB9XG5cbiAgICBjb25zdCByZXF1ZXN0ID0gbmV3IFJlcXVlc3QoYCR7dGhpcy5iYXNlVXJsfSR7cG9zdFVybH1gLCB7XG4gICAgICBtZXRob2QsXG4gICAgICBtb2RlOiB0aGlzLm1vZGUsXG4gICAgICBib2R5LFxuICAgICAgY3JlZGVudGlhbHM6IHRoaXMuY3JlZGVudGlhbHMsXG4gICAgfSk7XG5cbiAgICByZXR1cm4gZmV0Y2gocmVxdWVzdClcbiAgICAgIC50aGVuKChyZXNwb25zZSkgPT4ge1xuICAgICAgICBpZiAocmVzcG9uc2Uuc3RhdHVzICE9PSAyMDApIHtcbiAgICAgICAgICByZXR1cm4gJ2Vycm9yJztcbiAgICAgICAgfVxuXG4gICAgICAgIGlmIChmb3JtYXQgPT09ICdqc29uJykge1xuICAgICAgICAgIHJldHVybiByZXNwb25zZS5qc29uKCk7XG4gICAgICAgIH1cblxuICAgICAgICByZXR1cm4gcmVzcG9uc2UudGV4dCgpO1xuICAgICAgfSlcbiAgICAgIC50aGVuKChyZXNwb25zZVZhbHVlKSA9PiB7XG4gICAgICAgIGlmIChmb3JtYXQgPT09ICdodG1sJykge1xuICAgICAgICAgIGNvbnN0IHBhcnNlciA9IG5ldyBET01QYXJzZXIoKTtcbiAgICAgICAgICBjb25zdCBwYXJzZWREb2N1bWVudCA9IHBhcnNlci5wYXJzZUZyb21TdHJpbmcocmVzcG9uc2VWYWx1ZSwgXCJ0ZXh0L2h0bWxcIik7XG5cbiAgICAgICAgICB0aGlzLmRlbGV0ZVNjcmlwdFRhZ0RvbSgpO1xuICAgICAgICAgIHRoaXMuaW5zZXJ0U2NyaXB0VGFnSW5Eb20ocGFyc2VkRG9jdW1lbnQpO1xuICAgICAgICB9XG5cbiAgICAgICAgICByZXR1cm4gcmVzcG9uc2VWYWx1ZTtcbiAgICAgIH0pO1xuICB9XG5cbiAgLyoqXG4gICAqIG1ldGhvZCB0byBkZWxldGUgc2NyaXB0IHRhZ3MgaW4gcGFyZW50IGRvY3VtZW50XG4gICAqL1xuICBkZWxldGVTY3JpcHRUYWdEb20oKSB7XG4gICAgZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnc2NyaXB0W2RhdGEtcmlic2FqYXhzY3JpcHRdJykuZm9yRWFjaCgoZWxlbWVudCkgPT4ge1xuICAgICAgZG9jdW1lbnQuYm9keS5yZW1vdmVDaGlsZChlbGVtZW50KTtcbiAgICB9KTtcbiAgfVxuXG4gIC8qKlxuICAgKiBtZXRob2QgdG8gaW5zZXJ0IHNjcmlwdCB0YWdzIGluIHBhcmVudCBkb2N1bWVudFxuICAgKiBAcGFyYW0gcGFyc2VkRG9jdW1lbnRcbiAgICovXG4gIGluc2VydFNjcmlwdFRhZ0luRG9tKHBhcnNlZERvY3VtZW50KSB7XG4gICAgICBwYXJzZWREb2N1bWVudC5xdWVyeVNlbGVjdG9yQWxsKCdzY3JpcHQnKS5mb3JFYWNoKChlbGVtZW50KSA9PiB7XG4gICAgICAgIGNvbnN0IHNjcmlwdCA9IHBhcnNlZERvY3VtZW50LmNyZWF0ZUVsZW1lbnQoXCJzY3JpcHRcIik7XG4gICAgICAgIHNjcmlwdC5zcmMgPSBlbGVtZW50LnNyYztcbiAgICAgICAgc2NyaXB0LmRhdGFzZXQucmlic2FqYXhzY3JpcHQgPSAnJztcbiAgICAgICAgZG9jdW1lbnQuYm9keS5hcHBlbmRDaGlsZChzY3JpcHQpO1xuICAgICAgfSk7XG4gIH1cbn1cblxuZXhwb3J0IGRlZmF1bHQgUmlic0FwaTtcbiJdLCJzb3VyY2VSb290IjoiIn0=