(self["webpackChunk"] = self["webpackChunk"] || []).push([["/js/app"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Index.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Index.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  created: function created() {
    this.$store.dispatch('getProducts');
  },
  computed: {
    products: function products() {
      return this.$store.state.products;
    }
  },
  methods: {
    sendRequestForArticles: function sendRequestForArticles(page) {
      this.$store.dispatch('getProducts', {
        page: page
      });
    }
  }
});

/***/ }),

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm.js");
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
/* harmony import */ var _components_Index__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./components/Index */ "./resources/js/components/Index.vue");




__webpack_require__(/*! ./bootstrap */ "./resources/js/bootstrap.js");

__webpack_require__(/*! ./buefy */ "./resources/js/buefy.js");

vue__WEBPACK_IMPORTED_MODULE_1__["default"].use(vuex__WEBPACK_IMPORTED_MODULE_2__["default"]);
vue__WEBPACK_IMPORTED_MODULE_1__["default"].component('Index', _components_Index__WEBPACK_IMPORTED_MODULE_0__["default"]);
var store = new vuex__WEBPACK_IMPORTED_MODULE_2__["default"].Store({
  state: {
    cart: [],
    products: [],
    pages: 1,
    currentPage: 1
  },
  mutations: {
    setProducts: function setProducts(state, products) {
      state.products = products;
    },
    setCurrentPage: function setCurrentPage(state, currentPage) {
      state.currentPage = currentPage;
    },
    addProductToCart: function addProductToCart(state, product) {
      // console.log("llegue aca con el producto"+product.product_name)
      var duplicatedProductIndex = state.cart.findIndex(function (item) {
        return item.id === product.id;
      });

      if (duplicatedProductIndex !== -1) {
        state.cart[duplicatedProductIndex].qty++;
        return;
      }

      product.qty = 1;
      state.cart.push(product);
    },
    removeProductToCart: function removeProductToCart(state, index) {
      state.cart.splice(index, 1);
    }
  },
  actions: {
    getProducts: function getProducts(_ref, page) {
      var _this = this;

      var commit = _ref.commit;
      var pageAux = '';

      if (typeof page !== 'undefined') {
        pageAux = page.page;
      } else {
        pageAux = this.currentPage;
      } //   axios.get('/api/products?page='+pageAux)


      axios.get('/api/products?page=' + pageAux).then(function (response) {
        _this.state.pages = response.data.last_page; //this.state.currentPage=response.data.current_page

        commit('setCurrentPage', response.data.current_page);
        commit('setProducts', response.data);
      })["catch"](function (error) {
        return console.error(error);
      });
    }
  }
});
var app = new vue__WEBPACK_IMPORTED_MODULE_1__["default"]({
  store: store,
  el: '#app'
});

/***/ }),

/***/ "./resources/js/bootstrap.js":
/*!***********************************!*\
  !*** ./resources/js/bootstrap.js ***!
  \***********************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

window._ = __webpack_require__(/*! lodash */ "./node_modules/lodash/lodash.js");
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
/**
 * We'll load the Vue JS library. The Progressive JavaScript Framework
 */

window.Vue = (__webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm.js")["default"]);

/***/ }),

/***/ "./resources/js/buefy.js":
/*!*******************************!*\
  !*** ./resources/js/buefy.js ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var buefy__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! buefy */ "./node_modules/buefy/dist/esm/index.js");

Vue.use(buefy__WEBPACK_IMPORTED_MODULE_0__["default"]);

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/js/components/Index.vue":
/*!*******************************************!*\
  !*** ./resources/js/components/Index.vue ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Index_vue_vue_type_template_id_bb962f12___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Index.vue?vue&type=template&id=bb962f12& */ "./resources/js/components/Index.vue?vue&type=template&id=bb962f12&");
/* harmony import */ var _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Index.vue?vue&type=script&lang=js& */ "./resources/js/components/Index.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Index_vue_vue_type_template_id_bb962f12___WEBPACK_IMPORTED_MODULE_0__.render,
  _Index_vue_vue_type_template_id_bb962f12___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Index.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/Index.vue?vue&type=script&lang=js&":
/*!********************************************************************!*\
  !*** ./resources/js/components/Index.vue?vue&type=script&lang=js& ***!
  \********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Index.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Index.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Index.vue?vue&type=template&id=bb962f12&":
/*!**************************************************************************!*\
  !*** ./resources/js/components/Index.vue?vue&type=template&id=bb962f12& ***!
  \**************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_bb962f12___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_bb962f12___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_bb962f12___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Index.vue?vue&type=template&id=bb962f12& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Index.vue?vue&type=template&id=bb962f12&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Index.vue?vue&type=template&id=bb962f12&":
/*!*****************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Index.vue?vue&type=template&id=bb962f12& ***!
  \*****************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function () {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c("h1", { staticClass: "title" }, [
      _vm._v("Welcome to our awesome market"),
    ]),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "columns is-multiline" },
      _vm._l(_vm.products.data, function (product) {
        return _c(
          "div",
          { key: product.id, staticClass: "column is-one-third" },
          [
            _c("div", { staticClass: "card" }, [
              _c("div", { staticClass: "card-image" }, [
                _c("figure", { staticClass: "image is-4by3" }, [
                  _c("img", { attrs: { src: product.url_product_img } }),
                ]),
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "card-content" }, [
                _c("div", { staticClass: "media" }, [
                  _c("div", { staticClass: "media-content" }, [
                    _c("p", { staticClass: "title is-4" }, [
                      _vm._v(_vm._s(product.product_name)),
                    ]),
                    _vm._v(" "),
                    _c("p", { staticClass: "subtitle is-6" }),
                  ]),
                  _vm._v(" "),
                  _c(
                    "div",
                    { staticClass: "media-right" },
                    [
                      _c("b-button", {
                        attrs: {
                          rounded: "",
                          type: "is-dark",
                          size: "is-large",
                          "icon-right": "cart-variant",
                        },
                        on: {
                          click: function ($event) {
                            return _vm.$store.commit(
                              "addProductToCart",
                              product
                            )
                          },
                        },
                      }),
                    ],
                    1
                  ),
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "content" }, [
                  _vm._v(
                    "\n                        $ " +
                      _vm._s(product.list_price) +
                      "\n                    "
                  ),
                ]),
              ]),
            ]),
          ]
        )
      }),
      0
    ),
    _vm._v(" "),
    _c(
      "nav",
      {
        staticClass: "pagination is-centered",
        attrs: { role: "navigation", "aria-label": "pagination" },
      },
      [
        _c("span", { staticClass: "pagination-ellipsis" }, [_vm._v("…")]),
        _vm._v(" "),
        _c(
          "ul",
          { staticClass: "pagination-list" },
          _vm._l(_vm.products.links, function (page) {
            return _c("li", [
              page.label == "..."
                ? _c("div", [
                    _c("span", { staticClass: "pagination-ellipsis" }, [
                      _vm._v("…"),
                    ]),
                  ])
                : _c("div", [
                    page.label == _vm.products.current_page
                      ? _c("div", [
                          _c(
                            "a",
                            {
                              staticClass: "pagination-link is-current",
                              on: {
                                click: function ($event) {
                                  return _vm.sendRequestForArticles(page.label)
                                },
                              },
                            },
                            [_vm._v(_vm._s(page.label))]
                          ),
                        ])
                      : _c("div", [
                          page.label == "pagination.previous"
                            ? _c("div")
                            : page.label == "pagination.next"
                            ? _c("div")
                            : _c("div", [
                                _c(
                                  "a",
                                  {
                                    staticClass: "pagination-link",
                                    on: {
                                      click: function ($event) {
                                        return _vm.sendRequestForArticles(
                                          page.label
                                        )
                                      },
                                    },
                                  },
                                  [_vm._v(_vm._s(page.label))]
                                ),
                              ]),
                        ]),
                  ]),
            ])
          }),
          0
        ),
      ]
    ),
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["css/app","/js/vendor"], () => (__webpack_exec__("./resources/js/app.js"), __webpack_exec__("./resources/sass/app.scss")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);