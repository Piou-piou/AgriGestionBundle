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
      if (field.value.length > 2) {
        api.post(field.dataset.url, { autocomplete: field.value }, 'html').then(function (data) {
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
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vd2VicGFjay9ib290c3RyYXAiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL2pzL21haW4uanMiLCJ3ZWJwYWNrOi8vLy4vbm9kZV9tb2R1bGVzL3JpYnMtYXBpL1JpYnNBcGkuanMiXSwibmFtZXMiOlsiYXBpIiwiUmlic0FwaSIsInJpYnNGb3JtcyIsImRvY3VtZW50IiwiYXV0b2NvbXBsZXRlRmllbGRzIiwiZm9ybSIsImF1dG9jb21wbGV0ZUZpZWxkIiwiZmllbGQiLCJldmVudCIsImF1dG9jb21wbGV0ZSIsImNvbnNvbGUiXSwibWFwcGluZ3MiOiI7UUFBQTtRQUNBOztRQUVBO1FBQ0E7O1FBRUE7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7O1FBRUE7UUFDQTs7UUFFQTtRQUNBOztRQUVBO1FBQ0E7UUFDQTs7O1FBR0E7UUFDQTs7UUFFQTtRQUNBOztRQUVBO1FBQ0E7UUFDQTtRQUNBLDBDQUEwQyxnQ0FBZ0M7UUFDMUU7UUFDQTs7UUFFQTtRQUNBO1FBQ0E7UUFDQSx3REFBd0Qsa0JBQWtCO1FBQzFFO1FBQ0EsaURBQWlELGNBQWM7UUFDL0Q7O1FBRUE7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBLHlDQUF5QyxpQ0FBaUM7UUFDMUUsZ0hBQWdILG1CQUFtQixFQUFFO1FBQ3JJO1FBQ0E7O1FBRUE7UUFDQTtRQUNBO1FBQ0EsMkJBQTJCLDBCQUEwQixFQUFFO1FBQ3ZELGlDQUFpQyxlQUFlO1FBQ2hEO1FBQ0E7UUFDQTs7UUFFQTtRQUNBLHNEQUFzRCwrREFBK0Q7O1FBRXJIO1FBQ0E7OztRQUdBO1FBQ0E7Ozs7Ozs7Ozs7Ozs7OztBQ2xGQTs7Ozs7Ozs7QUFFQSxJQUFNQSxNQUFNLElBQUlDLFVBQUosUUFBWixFQUFZLENBQVo7QUFDQSxJQUFNQyxZQUFZQywwQkFBbEIsZ0JBQWtCQSxDQUFsQjs7QUFFQUQsa0JBQWtCLGdCQUFVO0FBQzFCLE1BQU1FLHFCQUFxQkMsc0JBQTNCLHFCQUEyQkEsQ0FBM0I7O0FBRUFELDZCQUEyQiw2QkFBdUI7QUFDaERFLGdEQUE0QyxpQkFBVztBQUNyRCxVQUFNQyxRQUFRQyxNQUFkO0FBQ0EsVUFBSUQscUJBQUosR0FBNEI7QUFDMUJQLGlCQUFTTyxjQUFUUCxLQUE0QixFQUFDUyxjQUFjRixNQUEzQ1AsS0FBNEIsRUFBNUJBLGVBQXNFLGdCQUFVO0FBQzlFVTtBQURGVjtBQUdEO0FBTkhNO0FBREZGO0FBSEZGLEc7Ozs7Ozs7Ozs7OztBQ0xBO0FBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxzQkFBc0IseUJBQXlCLElBQUkseUJBQXlCOztBQUU1RTtBQUNBLG9CQUFvQix5QkFBeUIsSUFBSSx5QkFBeUIsRUFBRSw0QkFBNEIscUJBQXFCLFFBQVE7QUFDckk7O0FBRUEsc0JBQXNCLFNBQVMsRUFBRSxRQUFRO0FBQ3pDO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBLGVBQWU7QUFDZjtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxlQUFlO0FBQ2Y7QUFDQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0EsS0FBSztBQUNMO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxlQUFlO0FBQ2Y7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTs7QUFFQSxtQ0FBbUMsYUFBYSxFQUFFLFFBQVE7QUFDMUQ7QUFDQTtBQUNBO0FBQ0E7QUFDQSxLQUFLOztBQUVMO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBOztBQUVBO0FBQ0EsT0FBTztBQUNQO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBLE9BQU87QUFDUDs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxLQUFLO0FBQ0w7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxPQUFPO0FBQ1A7QUFDQTs7QUFFZSxzRUFBTyxFQUFDIiwiZmlsZSI6ImpzL21haW4uanMiLCJzb3VyY2VzQ29udGVudCI6WyIgXHQvLyBUaGUgbW9kdWxlIGNhY2hlXG4gXHR2YXIgaW5zdGFsbGVkTW9kdWxlcyA9IHt9O1xuXG4gXHQvLyBUaGUgcmVxdWlyZSBmdW5jdGlvblxuIFx0ZnVuY3Rpb24gX193ZWJwYWNrX3JlcXVpcmVfXyhtb2R1bGVJZCkge1xuXG4gXHRcdC8vIENoZWNrIGlmIG1vZHVsZSBpcyBpbiBjYWNoZVxuIFx0XHRpZihpbnN0YWxsZWRNb2R1bGVzW21vZHVsZUlkXSkge1xuIFx0XHRcdHJldHVybiBpbnN0YWxsZWRNb2R1bGVzW21vZHVsZUlkXS5leHBvcnRzO1xuIFx0XHR9XG4gXHRcdC8vIENyZWF0ZSBhIG5ldyBtb2R1bGUgKGFuZCBwdXQgaXQgaW50byB0aGUgY2FjaGUpXG4gXHRcdHZhciBtb2R1bGUgPSBpbnN0YWxsZWRNb2R1bGVzW21vZHVsZUlkXSA9IHtcbiBcdFx0XHRpOiBtb2R1bGVJZCxcbiBcdFx0XHRsOiBmYWxzZSxcbiBcdFx0XHRleHBvcnRzOiB7fVxuIFx0XHR9O1xuXG4gXHRcdC8vIEV4ZWN1dGUgdGhlIG1vZHVsZSBmdW5jdGlvblxuIFx0XHRtb2R1bGVzW21vZHVsZUlkXS5jYWxsKG1vZHVsZS5leHBvcnRzLCBtb2R1bGUsIG1vZHVsZS5leHBvcnRzLCBfX3dlYnBhY2tfcmVxdWlyZV9fKTtcblxuIFx0XHQvLyBGbGFnIHRoZSBtb2R1bGUgYXMgbG9hZGVkXG4gXHRcdG1vZHVsZS5sID0gdHJ1ZTtcblxuIFx0XHQvLyBSZXR1cm4gdGhlIGV4cG9ydHMgb2YgdGhlIG1vZHVsZVxuIFx0XHRyZXR1cm4gbW9kdWxlLmV4cG9ydHM7XG4gXHR9XG5cblxuIFx0Ly8gZXhwb3NlIHRoZSBtb2R1bGVzIG9iamVjdCAoX193ZWJwYWNrX21vZHVsZXNfXylcbiBcdF9fd2VicGFja19yZXF1aXJlX18ubSA9IG1vZHVsZXM7XG5cbiBcdC8vIGV4cG9zZSB0aGUgbW9kdWxlIGNhY2hlXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLmMgPSBpbnN0YWxsZWRNb2R1bGVzO1xuXG4gXHQvLyBkZWZpbmUgZ2V0dGVyIGZ1bmN0aW9uIGZvciBoYXJtb255IGV4cG9ydHNcbiBcdF9fd2VicGFja19yZXF1aXJlX18uZCA9IGZ1bmN0aW9uKGV4cG9ydHMsIG5hbWUsIGdldHRlcikge1xuIFx0XHRpZighX193ZWJwYWNrX3JlcXVpcmVfXy5vKGV4cG9ydHMsIG5hbWUpKSB7XG4gXHRcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsIG5hbWUsIHsgZW51bWVyYWJsZTogdHJ1ZSwgZ2V0OiBnZXR0ZXIgfSk7XG4gXHRcdH1cbiBcdH07XG5cbiBcdC8vIGRlZmluZSBfX2VzTW9kdWxlIG9uIGV4cG9ydHNcbiBcdF9fd2VicGFja19yZXF1aXJlX18uciA9IGZ1bmN0aW9uKGV4cG9ydHMpIHtcbiBcdFx0aWYodHlwZW9mIFN5bWJvbCAhPT0gJ3VuZGVmaW5lZCcgJiYgU3ltYm9sLnRvU3RyaW5nVGFnKSB7XG4gXHRcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsIFN5bWJvbC50b1N0cmluZ1RhZywgeyB2YWx1ZTogJ01vZHVsZScgfSk7XG4gXHRcdH1cbiBcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsICdfX2VzTW9kdWxlJywgeyB2YWx1ZTogdHJ1ZSB9KTtcbiBcdH07XG5cbiBcdC8vIGNyZWF0ZSBhIGZha2UgbmFtZXNwYWNlIG9iamVjdFxuIFx0Ly8gbW9kZSAmIDE6IHZhbHVlIGlzIGEgbW9kdWxlIGlkLCByZXF1aXJlIGl0XG4gXHQvLyBtb2RlICYgMjogbWVyZ2UgYWxsIHByb3BlcnRpZXMgb2YgdmFsdWUgaW50byB0aGUgbnNcbiBcdC8vIG1vZGUgJiA0OiByZXR1cm4gdmFsdWUgd2hlbiBhbHJlYWR5IG5zIG9iamVjdFxuIFx0Ly8gbW9kZSAmIDh8MTogYmVoYXZlIGxpa2UgcmVxdWlyZVxuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy50ID0gZnVuY3Rpb24odmFsdWUsIG1vZGUpIHtcbiBcdFx0aWYobW9kZSAmIDEpIHZhbHVlID0gX193ZWJwYWNrX3JlcXVpcmVfXyh2YWx1ZSk7XG4gXHRcdGlmKG1vZGUgJiA4KSByZXR1cm4gdmFsdWU7XG4gXHRcdGlmKChtb2RlICYgNCkgJiYgdHlwZW9mIHZhbHVlID09PSAnb2JqZWN0JyAmJiB2YWx1ZSAmJiB2YWx1ZS5fX2VzTW9kdWxlKSByZXR1cm4gdmFsdWU7XG4gXHRcdHZhciBucyA9IE9iamVjdC5jcmVhdGUobnVsbCk7XG4gXHRcdF9fd2VicGFja19yZXF1aXJlX18ucihucyk7XG4gXHRcdE9iamVjdC5kZWZpbmVQcm9wZXJ0eShucywgJ2RlZmF1bHQnLCB7IGVudW1lcmFibGU6IHRydWUsIHZhbHVlOiB2YWx1ZSB9KTtcbiBcdFx0aWYobW9kZSAmIDIgJiYgdHlwZW9mIHZhbHVlICE9ICdzdHJpbmcnKSBmb3IodmFyIGtleSBpbiB2YWx1ZSkgX193ZWJwYWNrX3JlcXVpcmVfXy5kKG5zLCBrZXksIGZ1bmN0aW9uKGtleSkgeyByZXR1cm4gdmFsdWVba2V5XTsgfS5iaW5kKG51bGwsIGtleSkpO1xuIFx0XHRyZXR1cm4gbnM7XG4gXHR9O1xuXG4gXHQvLyBnZXREZWZhdWx0RXhwb3J0IGZ1bmN0aW9uIGZvciBjb21wYXRpYmlsaXR5IHdpdGggbm9uLWhhcm1vbnkgbW9kdWxlc1xuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5uID0gZnVuY3Rpb24obW9kdWxlKSB7XG4gXHRcdHZhciBnZXR0ZXIgPSBtb2R1bGUgJiYgbW9kdWxlLl9fZXNNb2R1bGUgP1xuIFx0XHRcdGZ1bmN0aW9uIGdldERlZmF1bHQoKSB7IHJldHVybiBtb2R1bGVbJ2RlZmF1bHQnXTsgfSA6XG4gXHRcdFx0ZnVuY3Rpb24gZ2V0TW9kdWxlRXhwb3J0cygpIHsgcmV0dXJuIG1vZHVsZTsgfTtcbiBcdFx0X193ZWJwYWNrX3JlcXVpcmVfXy5kKGdldHRlciwgJ2EnLCBnZXR0ZXIpO1xuIFx0XHRyZXR1cm4gZ2V0dGVyO1xuIFx0fTtcblxuIFx0Ly8gT2JqZWN0LnByb3RvdHlwZS5oYXNPd25Qcm9wZXJ0eS5jYWxsXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLm8gPSBmdW5jdGlvbihvYmplY3QsIHByb3BlcnR5KSB7IHJldHVybiBPYmplY3QucHJvdG90eXBlLmhhc093blByb3BlcnR5LmNhbGwob2JqZWN0LCBwcm9wZXJ0eSk7IH07XG5cbiBcdC8vIF9fd2VicGFja19wdWJsaWNfcGF0aF9fXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLnAgPSBcIi9idW5kbGVzL2FncmlnZXN0aW9uL1wiO1xuXG5cbiBcdC8vIExvYWQgZW50cnkgbW9kdWxlIGFuZCByZXR1cm4gZXhwb3J0c1xuIFx0cmV0dXJuIF9fd2VicGFja19yZXF1aXJlX18oX193ZWJwYWNrX3JlcXVpcmVfXy5zID0gMCk7XG4iLCJpbXBvcnQgUmlic0FwaSBmcm9tIFwicmlicy1hcGlcIjtcblxuY29uc3QgYXBpID0gbmV3IFJpYnNBcGkoJycpO1xuY29uc3Qgcmlic0Zvcm1zID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnZm9ybS5yaWJzLWZvcm0nKTtcblxucmlic0Zvcm1zLmZvckVhY2goKGZvcm0pID0+IHtcbiAgY29uc3QgYXV0b2NvbXBsZXRlRmllbGRzID0gZm9ybS5xdWVyeVNlbGVjdG9yQWxsKCcuaW5wdXQtYXV0b2NvbXBsZXRlJyk7XG5cbiAgYXV0b2NvbXBsZXRlRmllbGRzLmZvckVhY2goKGF1dG9jb21wbGV0ZUZpZWxkKSA9PiB7XG4gICAgYXV0b2NvbXBsZXRlRmllbGQuYWRkRXZlbnRMaXN0ZW5lcigna2V5dXAnLCAoZXZlbnQpID0+IHtcbiAgICAgIGNvbnN0IGZpZWxkID0gZXZlbnQuY3VycmVudFRhcmdldDtcbiAgICAgIGlmIChmaWVsZC52YWx1ZS5sZW5ndGggPiAyKSB7XG4gICAgICAgIGFwaS5wb3N0KGZpZWxkLmRhdGFzZXQudXJsLCB7YXV0b2NvbXBsZXRlOiBmaWVsZC52YWx1ZX0sICdodG1sJykudGhlbigoZGF0YSkgPT4ge1xuICAgICAgICAgIGNvbnNvbGUubG9nKGRhdGEpO1xuICAgICAgICB9KTtcbiAgICAgIH1cbiAgICB9KTtcbiAgfSk7XG59KTtcbiIsImNsYXNzIFJpYnNBcGkge1xuICAvKipcbiAgICogQHBhcmFtIGJhc2VVcmwgc3RyaW5nIHRoYXQgY29udGFpbnMgdGhlIGJhc2UgdXJsIHdpdGggdGhlIHNsYXNoIG9mIGVuZCB0aGF0IHdpbGwgYmUgY2FsbGVkXG4gICAqIEBwYXJhbSBtb2RlIGdldHRpbmcgbW9kZSBvZiB0aGUgdXJsLCBjb3JzLCBuby1jb3JzLCAuLi5cbiAgICogQHBhcmFtIGNyZWRlbnRpYWxzIG9mIHRoZSB1cmwgbGlrZSBzYW1lLW9yaWdpblxuICAgKi9cbiAgY29uc3RydWN0b3IoYmFzZVVybCwgbW9kZSwgY3JlZGVudGlhbHMpIHtcbiAgICBsZXQgc3RhcnRVcmwgPSBgJHt3aW5kb3cubG9jYXRpb24ucHJvdG9jb2x9Ly8ke3dpbmRvdy5sb2NhdGlvbi5ob3N0bmFtZX0vYDtcblxuICAgIGlmICghd2luZG93Lm9yaWdpbiAmJiBtb2RlICE9PSAnY29ycycpIHtcbiAgICAgIHN0YXJ0VXJsID0gYCR7d2luZG93LmxvY2F0aW9uLnByb3RvY29sfS8vJHt3aW5kb3cubG9jYXRpb24uaG9zdG5hbWV9JHsod2luZG93LmxvY2F0aW9uLnBvcnQgPyBgOiR7d2luZG93LmxvY2F0aW9uLnBvcnR9YCA6ICcnKX1gO1xuICAgIH1cblxuICAgIHRoaXMuYmFzZVVybCA9IGAke3N0YXJ0VXJsfSR7YmFzZVVybH1gO1xuICAgIHRoaXMubW9kZSA9IG1vZGU7XG4gICAgdGhpcy5jcmVkZW50aWFscyA9IGNyZWRlbnRpYWxzO1xuICB9XG5cbiAgLyoqXG4gICAqIG1ldGhvZCB0byBnZXQgYSB1cmwgYnkgZ2V0IG1ldGhvZFxuICAgKiBAcGFyYW0gdXJsXG4gICAqIEBwYXJhbSBmb3JtYXRcbiAgICogQHJldHVybnMge1Byb21pc2U8UmVzcG9uc2U+fVxuICAgKi9cbiAgZ2V0KHVybCwgZm9ybWF0ID0gJ2pzb24nKSB7XG4gICAgcmV0dXJuIHRoaXMuZXhlY1JlcXVlc3QoJ0dFVCcsIHVybCwgZm9ybWF0KTtcbiAgfVxuXG4gIC8qKlxuICAgKiBtZXRob2QgdG8gc2VuZCBhIHJlcXVlc3Qgd2l0aCBwb3N0IG1ldGhvZCB0byBhIHVybCB3aXRoIGRhdGFzXG4gICAqIGRhdGFzIGNhbiBiZSBhIGZvcm0gZGF0YSBvciBhbiBvYmplY3QgdGhhdCB3aWxsIGJlIHRyYW5zZm9ybSB0byBhIEZvcm1EYXRhIG9iamVjdFxuICAgKiBAcGFyYW0gdXJsXG4gICAqIEBwYXJhbSBkYXRhXG4gICAqIEBwYXJhbSBmb3JtYXRcbiAgICogQHJldHVybnMgeyp9XG4gICAqL1xuICBwb3N0KHVybCwgZGF0YSwgZm9ybWF0ID0gJ2pzb24nKSB7XG4gICAgbGV0IGZvcm1EYXRhO1xuXG4gICAgaWYgKCEoZGF0YSBpbnN0YW5jZW9mIEZvcm1EYXRhKSkge1xuICAgICAgZm9ybURhdGEgPSBuZXcgRm9ybURhdGEoKTtcblxuICAgICAgZm9yIChjb25zdCB0ZW1wRGF0YSBpbiBkYXRhKSB7XG4gICAgICAgIGZvcm1EYXRhLmFwcGVuZCh0ZW1wRGF0YSwgZGF0YVt0ZW1wRGF0YV0pO1xuICAgICAgfVxuICAgIH0gZWxzZSB7XG4gICAgICBmb3JtRGF0YSA9IGRhdGE7XG4gICAgfVxuXG4gICAgcmV0dXJuIHRoaXMuZXhlY1JlcXVlc3QoJ1BPU1QnLCB1cmwsIGZvcm1hdCwgZm9ybURhdGEpO1xuICB9XG5cbiAgLyoqXG4gICAqIG1ldGhvZCB0aGF0IHNlbmQgYWxsIHR5cGVzIG9mIHJlcXVlc3QgdG8gYSBnaXZlbiB1cmxcbiAgICogQHBhcmFtIG1ldGhvZFxuICAgKiBAcGFyYW0gdXJsXG4gICAqIEBwYXJhbSBmb3JtYXRcbiAgICogQHBhcmFtIGJvZHlcbiAgICogQHJldHVybnMge1Byb21pc2U8UmVzcG9uc2U+fVxuICAgKi9cbiAgZXhlY1JlcXVlc3QobWV0aG9kLCB1cmwsIGZvcm1hdCwgYm9keSA9IG51bGwpIHtcbiAgICBsZXQgcG9zdFVybCA9IHVybDtcblxuICAgIGlmICh1cmxbMF0gPT09ICcvJykge1xuICAgICAgcG9zdFVybCA9IHVybC5zdWJzdHIoMSk7XG4gICAgfVxuXG4gICAgY29uc3QgcmVxdWVzdCA9IG5ldyBSZXF1ZXN0KGAke3RoaXMuYmFzZVVybH0ke3Bvc3RVcmx9YCwge1xuICAgICAgbWV0aG9kLFxuICAgICAgbW9kZTogdGhpcy5tb2RlLFxuICAgICAgYm9keSxcbiAgICAgIGNyZWRlbnRpYWxzOiB0aGlzLmNyZWRlbnRpYWxzLFxuICAgIH0pO1xuXG4gICAgcmV0dXJuIGZldGNoKHJlcXVlc3QpXG4gICAgICAudGhlbigocmVzcG9uc2UpID0+IHtcbiAgICAgICAgaWYgKHJlc3BvbnNlLnN0YXR1cyAhPT0gMjAwKSB7XG4gICAgICAgICAgcmV0dXJuICdlcnJvcic7XG4gICAgICAgIH1cblxuICAgICAgICBpZiAoZm9ybWF0ID09PSAnanNvbicpIHtcbiAgICAgICAgICByZXR1cm4gcmVzcG9uc2UuanNvbigpO1xuICAgICAgICB9XG5cbiAgICAgICAgcmV0dXJuIHJlc3BvbnNlLnRleHQoKTtcbiAgICAgIH0pXG4gICAgICAudGhlbigocmVzcG9uc2VWYWx1ZSkgPT4ge1xuICAgICAgICBpZiAoZm9ybWF0ID09PSAnaHRtbCcpIHtcbiAgICAgICAgICBjb25zdCBwYXJzZXIgPSBuZXcgRE9NUGFyc2VyKCk7XG4gICAgICAgICAgY29uc3QgcGFyc2VkRG9jdW1lbnQgPSBwYXJzZXIucGFyc2VGcm9tU3RyaW5nKHJlc3BvbnNlVmFsdWUsIFwidGV4dC9odG1sXCIpO1xuXG4gICAgICAgICAgdGhpcy5kZWxldGVTY3JpcHRUYWdEb20oKTtcbiAgICAgICAgICB0aGlzLmluc2VydFNjcmlwdFRhZ0luRG9tKHBhcnNlZERvY3VtZW50KTtcbiAgICAgICAgfVxuXG4gICAgICAgICAgcmV0dXJuIHJlc3BvbnNlVmFsdWU7XG4gICAgICB9KTtcbiAgfVxuXG4gIC8qKlxuICAgKiBtZXRob2QgdG8gZGVsZXRlIHNjcmlwdCB0YWdzIGluIHBhcmVudCBkb2N1bWVudFxuICAgKi9cbiAgZGVsZXRlU2NyaXB0VGFnRG9tKCkge1xuICAgIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJ3NjcmlwdFtkYXRhLXJpYnNhamF4c2NyaXB0XScpLmZvckVhY2goKGVsZW1lbnQpID0+IHtcbiAgICAgIGRvY3VtZW50LmJvZHkucmVtb3ZlQ2hpbGQoZWxlbWVudCk7XG4gICAgfSk7XG4gIH1cblxuICAvKipcbiAgICogbWV0aG9kIHRvIGluc2VydCBzY3JpcHQgdGFncyBpbiBwYXJlbnQgZG9jdW1lbnRcbiAgICogQHBhcmFtIHBhcnNlZERvY3VtZW50XG4gICAqL1xuICBpbnNlcnRTY3JpcHRUYWdJbkRvbShwYXJzZWREb2N1bWVudCkge1xuICAgICAgcGFyc2VkRG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnc2NyaXB0JykuZm9yRWFjaCgoZWxlbWVudCkgPT4ge1xuICAgICAgICBjb25zdCBzY3JpcHQgPSBwYXJzZWREb2N1bWVudC5jcmVhdGVFbGVtZW50KFwic2NyaXB0XCIpO1xuICAgICAgICBzY3JpcHQuc3JjID0gZWxlbWVudC5zcmM7XG4gICAgICAgIHNjcmlwdC5kYXRhc2V0LnJpYnNhamF4c2NyaXB0ID0gJyc7XG4gICAgICAgIGRvY3VtZW50LmJvZHkuYXBwZW5kQ2hpbGQoc2NyaXB0KTtcbiAgICAgIH0pO1xuICB9XG59XG5cbmV4cG9ydCBkZWZhdWx0IFJpYnNBcGk7XG4iXSwic291cmNlUm9vdCI6IiJ9