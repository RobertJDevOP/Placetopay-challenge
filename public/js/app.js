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
//
//
//
//
//
//
//
//
//
var user = document.head.querySelector('meta[name="user"]');
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  data: function data() {
    return {
      modalShoppingCart: false,
      modalUserDataConfirmation: false,
      findByCategory: null,
      findByPriceRange: [0, 0],
      findByNameOfProduct: '',
      options: {
        'CC': 'CC-Cédula de ciudadanía',
        'CE': 'CE-Cédula de extranjería',
        'TI': 'TI-Tarjeta de identidad',
        'NIT': 'NIT-Número de Identificación',
        'RUT': 'RUT-Registro único tributario'
      },
      categoryData: []
    };
  },
  created: function created() {
    var _this = this;

    this.$store.dispatch('getProducts');
    axios.get('/api/categories').then(function (response) {
      _this.categoryData = response.data;
    })["catch"](function (error) {
      return console.error(error);
    });
  },
  computed: {
    products: function products() {
      return this.$store.state.products;
    },
    getUser: function getUser() {
      return JSON.parse(user.content);
    },
    getCart: function getCart() {
      return this.$store.state.cart;
    },
    totalProduct: function totalProduct() {
      return this.$store.state.cart.reduce(function (acc, current) {
        return acc + current.qty;
      }, 0);
    },
    totalPrice: function totalPrice() {
      return this.$store.state.cart.reduce(function (acc, current) {
        return acc + current.list_price * current.qty;
      }, 0);
    }
  },
  methods: {
    openModalShoppingCart: function openModalShoppingCart() {
      this.modalShoppingCart = true;
    },
    getProducts: function getProducts(page) {
      this.$store.dispatch('getProducts', {
        page: page
      });
    },
    searchData: function searchData() {
      this.$store.dispatch('getProducts', {
        page: this.products.current_page,
        filters: [{
          'findByCategory': this.findByCategory,
          'findByPriceRange': this.findByPriceRange,
          'findByNameOfProduct': this.findByNameOfProduct
        }]
      });
    },
    openModalUserDataConfirmation: function openModalUserDataConfirmation() {
      // HACER VALIDACIONES RESPECTIVAS A LA CANTIDAD DEL CARRITO DE COMPRAS JEJE y demas
      // cierro el modal----
      this.modalShoppingCart = false;
      this.modalUserDataConfirmation = true;
    },
    confirmPayment: function confirmPayment() {
      var _this2 = this;

      //  VALIDAR DATOS ANTES DE PROCESAR..........
      var productsPayment = this.$store.state.cart;
      var totalPrice = this.totalPrice;
      var totalProduct = this.totalProduct;
      axios.post('/storeShoppingCart', {
        params: {
          productsPayment: productsPayment,
          totalProduct: totalProduct,
          totalPrice: totalPrice
        }
      }, {}).then(function (response) {
        _this2.modalUserDataConfirmation = false;
        window.open(response.data, '_blank'); //  P.init(response.data, { opacity: 0.4 });
      })["catch"](function (error) {
        return console.error(error);
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Reportsgeneratetable.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Reportsgeneratetable.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************************************************************/
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
//
//
//
//
//
//
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  data: function data() {
    return {
      finishDate: [],
      startDate: [],
      options: {
        0: 'Reporte por ventas',
        1: 'Reporte por usuarios'
      },
      reports: [],
      batchProgress: 100
    };
  },
  methods: {
    searchData: function searchData() {
      var _this = this;

      axios.post('/generateReport', {
        params: {
          value: 'test'
        }
      }, {}).then(function (response) {
        _this.getReports();
      })["catch"](function (error) {
        return console.error(error);
      });
    },
    getReports: function getReports() {
      var _this2 = this;

      axios.get('/api/reports').then(function (response) {
        _this2.reports = response.data;
      })["catch"](function (error) {
        return console.error(error);
      });
    },
    getProgressBar: function getProgressBar() {}
  },
  mounted: function mounted() {
    var _this3 = this;

    this.getReports(); //set interval y la magia XD----

    setInterval(function () {
      if (_this3.batchProgress >= 100) {//console.log("ok mandandoo peticion..");
      }
    }, 6000);
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/TablePurchaseOrder.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/TablePurchaseOrder.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************************************************************/
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
  data: function data() {
    return {
      orders: [],
      columnsVisible: {
        reference: {
          title: '# Number',
          display: true
        },
        quantity: {
          title: 'Product quantity',
          display: true
        },
        total: {
          title: 'Total price',
          display: true
        },
        created: {
          title: 'Order created at',
          display: true
        },
        detail: {
          title: 'Purchase order detail',
          display: true
        }
      },
      showDetailIcon: true
    };
  },
  mounted: function mounted() {
    var _this = this;

    axios.get('/api/orders').then(function (response) {
      var purchaseOrdersArray = [];
      purchaseOrdersArray = Object.keys(response.data).map(function (field) {
        return {
          data: response.data[field]
        };
      });
      console.log(purchaseOrdersArray[0].data.purchase_payments_status);
      _this.orders = purchaseOrdersArray;
    })["catch"](function (error) {
      return console.error(error);
    });
  },
  methods: {
    toggle: function toggle(row) {
      this.$refs.table.toggleDetails(row);
    },
    retryPayment: function retryPayment(purchaseOrderId) {
      var _this2 = this;

      axios.post('retryPayment', {
        params: {
          purchaseOrderId: purchaseOrderId
        }
      }, {}).then(function (response) {
        _this2.modalUserDataConfirmation = false;
        window.open(response.data, '_blank');
      })["catch"](function (error) {
        return console.error(error);
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
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm.js");
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
/* harmony import */ var _components_Index__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./components/Index */ "./resources/js/components/Index.vue");
/* harmony import */ var _components_TablePurchaseOrder__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./components/TablePurchaseOrder */ "./resources/js/components/TablePurchaseOrder.vue");
/* harmony import */ var _components_Reportsgeneratetable__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./components/Reportsgeneratetable */ "./resources/js/components/Reportsgeneratetable.vue");






__webpack_require__(/*! ./bootstrap */ "./resources/js/bootstrap.js");

__webpack_require__(/*! ./buefy */ "./resources/js/buefy.js");

vue__WEBPACK_IMPORTED_MODULE_3__["default"].use(vuex__WEBPACK_IMPORTED_MODULE_4__["default"]);
vue__WEBPACK_IMPORTED_MODULE_3__["default"].component('Index', _components_Index__WEBPACK_IMPORTED_MODULE_0__["default"]);
vue__WEBPACK_IMPORTED_MODULE_3__["default"].component('Purchaseorder', _components_TablePurchaseOrder__WEBPACK_IMPORTED_MODULE_1__["default"]);
vue__WEBPACK_IMPORTED_MODULE_3__["default"].component('Reportsgeneratetable', _components_Reportsgeneratetable__WEBPACK_IMPORTED_MODULE_2__["default"]);
var store = new vuex__WEBPACK_IMPORTED_MODULE_4__["default"].Store({
  state: {
    cart: [],
    products: [],
    dataUserAuth: {},
    pages: 1,
    currentPage: 1,
    isImageModalActive: false,
    isModalUserDataConf: false
  },
  mutations: {
    setProducts: function setProducts(state, products) {
      state.products = products;
    },
    setCurrentPage: function setCurrentPage(state, currentPage) {
      state.currentPage = currentPage;
    },
    addProductToCart: function addProductToCart(state, product) {
      var duplicatedProductIndex = state.cart.findIndex(function (item) {
        return item.id === product.id;
      });
      console.log(duplicatedProductIndex);

      if (duplicatedProductIndex !== -1) {
        //let increment =
        var item = state.cart[duplicatedProductIndex];
        item.qty++; // propiedad reactiva el array no lo era entonces toca ASI XDD lo agrego

        vue__WEBPACK_IMPORTED_MODULE_3__["default"].set(state.cart, duplicatedProductIndex, item);
        return;
      }

      product.qty = 1;
      state.cart.push(product);
    },
    removeProductToCart: function removeProductToCart(state, index) {
      state.cart.splice(index, 1);
    },
    totalPrice: function totalPrice() {
      return false;
    }
  },
  actions: {
    getProducts: function getProducts(_ref, page) {
      var _this = this;

      var commit = _ref.commit;
      var pageAux = '';
      var params = new URLSearchParams();

      if (typeof page !== 'undefined') {
        pageAux = page.page;
        params.append('product_name', page.filters[0].findByNameOfProduct);
        params.append('category', page.filters[0].findByCategory);
        params.append('range_price', page.filters[0].findByPriceRange);
      } else {
        pageAux = this.currentPage;
      }

      axios.get('/api/products?page=' + pageAux, {
        params: params
      }).then(function (response) {
        _this.state.pages = response.data.last_page;
        commit('setCurrentPage', response.data.current_page);
        commit('setProducts', response.data);
      })["catch"](function (error) {
        return console.error(error);
      });
    }
  }
});
var app = new vue__WEBPACK_IMPORTED_MODULE_3__["default"]({
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

/***/ "./resources/js/components/Reportsgeneratetable.vue":
/*!**********************************************************!*\
  !*** ./resources/js/components/Reportsgeneratetable.vue ***!
  \**********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Reportsgeneratetable_vue_vue_type_template_id_ca0c4ff6_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Reportsgeneratetable.vue?vue&type=template&id=ca0c4ff6&scoped=true& */ "./resources/js/components/Reportsgeneratetable.vue?vue&type=template&id=ca0c4ff6&scoped=true&");
/* harmony import */ var _Reportsgeneratetable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Reportsgeneratetable.vue?vue&type=script&lang=js& */ "./resources/js/components/Reportsgeneratetable.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Reportsgeneratetable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Reportsgeneratetable_vue_vue_type_template_id_ca0c4ff6_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render,
  _Reportsgeneratetable_vue_vue_type_template_id_ca0c4ff6_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  "ca0c4ff6",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Reportsgeneratetable.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/TablePurchaseOrder.vue":
/*!********************************************************!*\
  !*** ./resources/js/components/TablePurchaseOrder.vue ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _TablePurchaseOrder_vue_vue_type_template_id_63a29fca___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./TablePurchaseOrder.vue?vue&type=template&id=63a29fca& */ "./resources/js/components/TablePurchaseOrder.vue?vue&type=template&id=63a29fca&");
/* harmony import */ var _TablePurchaseOrder_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./TablePurchaseOrder.vue?vue&type=script&lang=js& */ "./resources/js/components/TablePurchaseOrder.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _TablePurchaseOrder_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _TablePurchaseOrder_vue_vue_type_template_id_63a29fca___WEBPACK_IMPORTED_MODULE_0__.render,
  _TablePurchaseOrder_vue_vue_type_template_id_63a29fca___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/TablePurchaseOrder.vue"
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

/***/ "./resources/js/components/Reportsgeneratetable.vue?vue&type=script&lang=js&":
/*!***********************************************************************************!*\
  !*** ./resources/js/components/Reportsgeneratetable.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Reportsgeneratetable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Reportsgeneratetable.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Reportsgeneratetable.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Reportsgeneratetable_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/TablePurchaseOrder.vue?vue&type=script&lang=js&":
/*!*********************************************************************************!*\
  !*** ./resources/js/components/TablePurchaseOrder.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_TablePurchaseOrder_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./TablePurchaseOrder.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/TablePurchaseOrder.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_TablePurchaseOrder_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

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

/***/ "./resources/js/components/Reportsgeneratetable.vue?vue&type=template&id=ca0c4ff6&scoped=true&":
/*!*****************************************************************************************************!*\
  !*** ./resources/js/components/Reportsgeneratetable.vue?vue&type=template&id=ca0c4ff6&scoped=true& ***!
  \*****************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Reportsgeneratetable_vue_vue_type_template_id_ca0c4ff6_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Reportsgeneratetable_vue_vue_type_template_id_ca0c4ff6_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Reportsgeneratetable_vue_vue_type_template_id_ca0c4ff6_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Reportsgeneratetable.vue?vue&type=template&id=ca0c4ff6&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Reportsgeneratetable.vue?vue&type=template&id=ca0c4ff6&scoped=true&");


/***/ }),

/***/ "./resources/js/components/TablePurchaseOrder.vue?vue&type=template&id=63a29fca&":
/*!***************************************************************************************!*\
  !*** ./resources/js/components/TablePurchaseOrder.vue?vue&type=template&id=63a29fca& ***!
  \***************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TablePurchaseOrder_vue_vue_type_template_id_63a29fca___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TablePurchaseOrder_vue_vue_type_template_id_63a29fca___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_TablePurchaseOrder_vue_vue_type_template_id_63a29fca___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./TablePurchaseOrder.vue?vue&type=template&id=63a29fca& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/TablePurchaseOrder.vue?vue&type=template&id=63a29fca&");


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
  return _c(
    "div",
    [
      _c("div", { staticClass: "columns" }, [
        _vm._m(0),
        _vm._v(" "),
        _c("div", { staticClass: "column" }, [
          _c(
            "button",
            {
              staticClass: "button is-medium is-black",
              on: {
                click: function ($event) {
                  return _vm.openModalShoppingCart()
                },
              },
            },
            [
              _vm._m(1),
              _c("span", {
                domProps: {
                  textContent: _vm._s(this.$store.state.cart.length),
                },
              }),
              _vm._v("   Cart"),
            ]
          ),
        ]),
      ]),
      _vm._v(" "),
      _c(
        "b-collapse",
        {
          staticClass: "card",
          attrs: { animation: "slide" },
          scopedSlots: _vm._u([
            {
              key: "trigger",
              fn: function (props) {
                return [
                  _c(
                    "div",
                    { staticClass: "card-header", attrs: { role: "button" } },
                    [
                      _c("p", { staticClass: "card-header-title" }, [
                        _vm._v("Filters"),
                      ]),
                      _vm._v(" "),
                      _c(
                        "a",
                        { staticClass: "card-header-icon" },
                        [
                          _c("b-icon", {
                            attrs: {
                              icon: props.open ? "menu-down" : "menu-up",
                            },
                          }),
                        ],
                        1
                      ),
                    ]
                  ),
                ]
              },
            },
          ]),
        },
        [
          _vm._v(" "),
          _c(
            "div",
            { staticClass: "card-content" },
            [
              _c("div", { staticClass: "columns" }, [
                _c(
                  "div",
                  { staticClass: "column is-4" },
                  [
                    _c(
                      "b-field",
                      { attrs: { label: "Find by Category" } },
                      [
                        _c(
                          "b-select",
                          {
                            attrs: {
                              placeholder: "Select name of the category",
                            },
                            model: {
                              value: _vm.findByCategory,
                              callback: function ($$v) {
                                _vm.findByCategory = $$v
                              },
                              expression: "findByCategory",
                            },
                          },
                          _vm._l(_vm.categoryData, function (indice) {
                            return _c(
                              "option",
                              {
                                key: indice.id,
                                domProps: { value: indice.id },
                              },
                              [
                                _vm._v(
                                  "\r\n                            " +
                                    _vm._s(indice.name_category) +
                                    "\r\n                        "
                                ),
                              ]
                            )
                          }),
                          0
                        ),
                      ],
                      1
                    ),
                  ],
                  1
                ),
                _vm._v(" "),
                _c("div", { staticClass: "column is-8" }, [
                  _c("label", { staticClass: "label" }, [
                    _vm._v("Find by name of the product"),
                  ]),
                  _vm._v(" "),
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.findByNameOfProduct,
                        expression: "findByNameOfProduct",
                      },
                    ],
                    staticClass: "input",
                    attrs: { type: "text", placeholder: "Name of the product" },
                    domProps: { value: _vm.findByNameOfProduct },
                    on: {
                      input: function ($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.findByNameOfProduct = $event.target.value
                      },
                    },
                  }),
                ]),
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "columns" }, [
                _c(
                  "div",
                  { staticClass: "column is-12" },
                  [
                    _c(
                      "b-field",
                      { attrs: { label: "Find by prince range" } },
                      [
                        _c("b-slider", {
                          attrs: { min: 1, max: 900000 },
                          model: {
                            value: _vm.findByPriceRange,
                            callback: function ($$v) {
                              _vm.findByPriceRange = $$v
                            },
                            expression: "findByPriceRange",
                          },
                        }),
                      ],
                      1
                    ),
                  ],
                  1
                ),
              ]),
              _vm._v(" "),
              _c(
                "b-button",
                {
                  attrs: {
                    type: "is-link",
                    "native-type": "submit",
                    "icon-left": "magnify",
                  },
                },
                [_vm._v("Clear")]
              ),
              _vm._v(" "),
              _c(
                "b-button",
                {
                  attrs: { "icon-left": "eraser" },
                  on: {
                    click: function ($event) {
                      return _vm.searchData()
                    },
                  },
                },
                [_vm._v("Search")]
              ),
            ],
            1
          ),
        ]
      ),
      _vm._v(" "),
      _c("hr"),
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
                    _c("img", { attrs: { src: product.image } }),
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
                      _c("p", { staticClass: "subtitle is-6" }, [
                        _vm._v(_vm._s(product.name_category)),
                      ]),
                    ]),
                    _vm._v(" "),
                    _c(
                      "div",
                      { staticClass: "media-right" },
                      [
                        _c("b-button", {
                          attrs: {
                            rounded: "",
                            type: "is-yellow",
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
                      "\r\n                        $ " +
                        _vm._s(product.list_price) +
                        "\r\n                    "
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
                                    return _vm.getProducts(page.label)
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
                                          return _vm.getProducts(page.label)
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
      _vm._v(" "),
      _c("div", { attrs: { id: "MostrarPlaceToPaY" } }),
      _vm._v(" "),
      _c(
        "b-modal",
        {
          attrs: { width: 1280, scroll: "keep" },
          model: {
            value: _vm.modalShoppingCart,
            callback: function ($$v) {
              _vm.modalShoppingCart = $$v
            },
            expression: "modalShoppingCart",
          },
        },
        [
          _c("header", { staticClass: "modal-card-head" }, [
            _c("p", { staticClass: "modal-card-title" }, [
              _vm._v("Shopping Cart"),
            ]),
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "card" }, [
            _c("div", { staticClass: "card-content" }, [
              _c(
                "div",
                { staticClass: "content" },
                [
                  _c("p", { staticClass: "title is-4" }, [
                    _vm._v(_vm._s(_vm.totalProduct) + "Products in your cart"),
                  ]),
                  _vm._v(" "),
                  _vm._l(_vm.getCart, function (product, index) {
                    return _c(
                      "div",
                      {
                        key: index,
                        staticClass:
                          "flex items-center hover:bg-gray-100 -mx-8 px-6 py-5",
                      },
                      [
                        _c("div", { staticClass: "box" }, [
                          _c("div", { staticClass: "media" }, [
                            _c("div", { staticClass: "media-left" }, [
                              _c("figure", { staticClass: "image is-48x48" }, [
                                _c("img", { attrs: { src: product.image } }),
                              ]),
                            ]),
                          ]),
                          _vm._v(
                            "\r\n\r\n                            " +
                              _vm._s(product.product_name) +
                              "\r\n                            Precio : " +
                              _vm._s(product.list_price) +
                              "\r\n                            Cantidad  : " +
                              _vm._s(product.qty) +
                              "\r\n                            Total :" +
                              _vm._s(product.list_price * product.qty) +
                              "\r\n                            "
                          ),
                          _c(
                            "a",
                            {
                              staticClass:
                                "font-semibold hover:text-red-500 text-gray-500 text-xs",
                              attrs: { href: "#" },
                              on: {
                                click: function ($event) {
                                  return _vm.$store.commit(
                                    "removeProductToCart",
                                    index
                                  )
                                },
                              },
                            },
                            [_vm._v("Eliminar del carrito")]
                          ),
                        ]),
                      ]
                    )
                  }),
                  _vm._v(
                    "\r\n\r\n                    Informations  Total price\r\n                    "
                  ),
                  _c("span", [_vm._v(_vm._s(_vm.totalPrice) + " $")]),
                  _vm._v(" "),
                  _c(
                    "b-button",
                    {
                      attrs: { type: "is-dark" },
                      on: {
                        click: function ($event) {
                          return _vm.openModalUserDataConfirmation()
                        },
                      },
                    },
                    [_vm._v("Payment")]
                  ),
                ],
                2
              ),
            ]),
          ]),
        ]
      ),
      _vm._v(" "),
      _c(
        "b-modal",
        {
          attrs: { width: 1280, scroll: "keep" },
          model: {
            value: _vm.modalUserDataConfirmation,
            callback: function ($$v) {
              _vm.modalUserDataConfirmation = $$v
            },
            expression: "modalUserDataConfirmation",
          },
        },
        [
          _c("header", { staticClass: "modal-card-head" }, [
            _c("p", { staticClass: "modal-card-title" }, [_vm._v("Payment ")]),
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "card" }, [
            _c("div", { staticClass: "card-content" }, [
              _c(
                "div",
                { staticClass: "content" },
                [
                  _c("p", { staticClass: "title is-4" }, [
                    _vm._v(
                      "Please check if the data is correct, if not you can update your data"
                    ),
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "columns" }, [
                    _c(
                      "div",
                      { staticClass: "column is-5" },
                      [
                        _c(
                          "b-field",
                          { attrs: { label: "Names" } },
                          [
                            _c("b-input", {
                              attrs: {
                                type: "text",
                                name: "name",
                                value: _vm.getUser.name,
                                maxlength: "255",
                              },
                            }),
                          ],
                          1
                        ),
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "div",
                      { staticClass: "column is-4" },
                      [
                        _c(
                          "b-field",
                          { attrs: { label: "Surnames" } },
                          [
                            _c("b-input", {
                              attrs: {
                                type: "text",
                                name: "surnames",
                                value: _vm.getUser.surnames,
                                maxlength: "255",
                              },
                            }),
                          ],
                          1
                        ),
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c("div", { staticClass: "column is-3" }, [
                      _c("label", { staticClass: "label" }, [
                        _vm._v("Document type"),
                      ]),
                      _vm._v(" "),
                      _c("div", { staticClass: "select" }, [
                        _c(
                          "select",
                          _vm._l(_vm.options, function (option, index) {
                            return _c(
                              "option",
                              {
                                domProps: {
                                  value: option.id,
                                  selected: index == _vm.getUser.document_type,
                                },
                              },
                              [_vm._v(_vm._s(option))]
                            )
                          }),
                          0
                        ),
                      ]),
                    ]),
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "columns" }, [
                    _c(
                      "div",
                      { staticClass: "column is-2" },
                      [
                        _c(
                          "b-field",
                          { attrs: { label: "Document number" } },
                          [
                            _c("b-input", {
                              attrs: {
                                type: "number",
                                value: _vm.getUser.number_document,
                                name: "number_document",
                                maxlength: "255",
                              },
                            }),
                          ],
                          1
                        ),
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "div",
                      { staticClass: "column is-2" },
                      [
                        _c(
                          "b-field",
                          { attrs: { label: "Email" } },
                          [
                            _c("b-input", {
                              attrs: {
                                type: "email",
                                name: "email",
                                value: _vm.getUser.email,
                                maxlength: "255",
                              },
                            }),
                          ],
                          1
                        ),
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "div",
                      { staticClass: "column is-2" },
                      [
                        _c(
                          "b-field",
                          { attrs: { label: "Cell phone" } },
                          [
                            _c("b-input", {
                              attrs: {
                                type: "number",
                                name: "cell_phone",
                                value: _vm.getUser.cell_phone,
                                maxlength: "255",
                              },
                            }),
                          ],
                          1
                        ),
                      ],
                      1
                    ),
                    _vm._v(" "),
                    _c(
                      "div",
                      { staticClass: "column is-6" },
                      [
                        _c(
                          "b-field",
                          { attrs: { label: "Residence address" } },
                          [
                            _c("b-input", {
                              attrs: {
                                type: "text",
                                name: "user_street",
                                value: _vm.getUser.user_street,
                                maxlength: "255",
                              },
                            }),
                          ],
                          1
                        ),
                      ],
                      1
                    ),
                  ]),
                  _vm._v(" "),
                  _c(
                    "b-button",
                    {
                      attrs: { type: "is-dark" },
                      on: {
                        click: function ($event) {
                          return _vm.confirmPayment()
                        },
                      },
                    },
                    [_vm._v("Confirm and pay")]
                  ),
                ],
                1
              ),
            ]),
          ]),
        ]
      ),
    ],
    1
  )
}
var staticRenderFns = [
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "column is-10" }, [
      _c("h1", { staticClass: "title" }, [
        _vm._v("Welcome to our awesome market"),
      ]),
    ])
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("span", { staticClass: "icon is-large" }, [
      _c("i", { staticClass: "mdi mdi-cart-variant" }),
    ])
  },
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Reportsgeneratetable.vue?vue&type=template&id=ca0c4ff6&scoped=true&":
/*!********************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/Reportsgeneratetable.vue?vue&type=template&id=ca0c4ff6&scoped=true& ***!
  \********************************************************************************************************************************************************************************************************************************************/
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
  return _c(
    "div",
    [
      _c(
        "b-collapse",
        {
          staticClass: "card",
          attrs: { animation: "slide" },
          scopedSlots: _vm._u([
            {
              key: "trigger",
              fn: function (props) {
                return [
                  _c(
                    "div",
                    { staticClass: "card-header", attrs: { role: "button" } },
                    [
                      _c("p", { staticClass: "card-header-title" }, [
                        _vm._v("Filters"),
                      ]),
                      _vm._v(" "),
                      _c(
                        "a",
                        { staticClass: "card-header-icon" },
                        [
                          _c("b-icon", {
                            attrs: {
                              icon: props.open ? "menu-down" : "menu-up",
                            },
                          }),
                        ],
                        1
                      ),
                    ]
                  ),
                ]
              },
            },
          ]),
        },
        [
          _vm._v(" "),
          _c("div", { staticClass: "card-content" }, [
            _c("div", { staticClass: "columns" }, [
              _c("div", { staticClass: "column is-2" }, [
                _c("label", { staticClass: "label" }, [_vm._v("Report type")]),
                _vm._v(" "),
                _c("div", { staticClass: "select" }, [
                  _c(
                    "select",
                    _vm._l(_vm.options, function (option, index) {
                      return _c("option", { domProps: { value: index } }, [
                        _vm._v(_vm._s(option)),
                      ])
                    }),
                    0
                  ),
                ]),
              ]),
              _vm._v(" "),
              _c(
                "div",
                { staticClass: "column is-4" },
                [
                  _c(
                    "b-field",
                    { attrs: { label: "Start date", type: "", message: "" } },
                    [
                      _c("b-datepicker", {
                        attrs: { selected: "", name: "", locale: "en-ca" },
                        model: {
                          value: _vm.startDate,
                          callback: function ($$v) {
                            _vm.startDate = $$v
                          },
                          expression: "startDate",
                        },
                      }),
                    ],
                    1
                  ),
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "div",
                { staticClass: "column is-4" },
                [
                  _c(
                    "b-field",
                    { attrs: { label: "Finish date", type: "", message: "" } },
                    [
                      _c("b-datepicker", {
                        attrs: { selected: "", name: "", locale: "en-ca" },
                        model: {
                          value: _vm.finishDate,
                          callback: function ($$v) {
                            _vm.finishDate = $$v
                          },
                          expression: "finishDate",
                        },
                      }),
                    ],
                    1
                  ),
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "div",
                { staticClass: "column is-2" },
                [
                  _c("br"),
                  _vm._v(" "),
                  _c(
                    "b-button",
                    {
                      attrs: {
                        type: "is-link",
                        "native-type": "submit",
                        "icon-left": "magnify",
                      },
                      on: {
                        click: function ($event) {
                          return _vm.searchData()
                        },
                      },
                    },
                    [_vm._v("Generate")]
                  ),
                ],
                1
              ),
            ]),
          ]),
        ]
      ),
      _vm._v(" "),
      _c("br"),
      _vm._v("Your reports\n    "),
      _c(
        "table",
        { staticClass: "table is-narrow is-hoverable is-fullwidth" },
        [
          _vm._m(0),
          _vm._v(" "),
          _c(
            "tbody",
            _vm._l(_vm.reports, function (report) {
              return _c("tr", { key: report.id_report }, [
                _c("td", [_vm._v(_vm._s(report.id_report))]),
                _vm._v(" "),
                _c("td", [_vm._v(_vm._s(report.batch_name))]),
                _vm._v(" "),
                _c(
                  "td",
                  [
                    _c("b-progress", {
                      attrs: { value: 80, "show-value": "", format: "percent" },
                    }),
                  ],
                  1
                ),
              ])
            }),
            0
          ),
        ]
      ),
    ],
    1
  )
}
var staticRenderFns = [
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", [
      _c("tr", [
        _c("th", [_vm._v("#")]),
        _vm._v(" "),
        _c("th", [_vm._v("Type of report")]),
        _vm._v(" "),
        _c("th", [_vm._v("Process")]),
      ]),
    ])
  },
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/TablePurchaseOrder.vue?vue&type=template&id=63a29fca&":
/*!******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/TablePurchaseOrder.vue?vue&type=template&id=63a29fca& ***!
  \******************************************************************************************************************************************************************************************************************************/
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
  return _c(
    "div",
    [
      _c(
        "b-table",
        {
          ref: "table",
          attrs: {
            data: _vm.orders,
            detailed: "",
            hoverable: "",
            "custom-detail-row": "",
            "default-sort": ["reference", "asc"],
            "detail-key": "id_purchase_order",
            paginated: "",
            "per-page": "5",
            "aria-next-label": "Next page",
            "aria-previous-label": "Previous page",
            "aria-page-label": "Page",
            "aria-current-label": "Current page",
            "show-detail-icon": _vm.showDetailIcon,
          },
          on: {
            "details-open": function (row, index) {
              return _vm.$buefy.toast.open("Expanded " + row.data.id)
            },
          },
          scopedSlots: _vm._u([
            {
              key: "detail",
              fn: function (props) {
                return _vm._l(
                  props.row.data.purchase_payments_status,
                  function (item) {
                    return _c("tr", { key: item.id }, [
                      _vm.showDetailIcon ? _c("td") : _vm._e(),
                      _vm._v(" "),
                      _c("td", [_vm._v("    ")]),
                      _vm._v(" "),
                      _c("td", { staticClass: "has-text-centered" }, [
                        _vm._v(
                          "\n                    Wallet status\n                    "
                        ),
                        item.status == "APPROVED"
                          ? _c("div", [
                              _c("span", { staticClass: "tag is-success" }, [
                                _vm._v(
                                  "\n                                " +
                                    _vm._s(item.status) +
                                    "\n                             "
                                ),
                              ]),
                            ])
                          : _vm._e(),
                        _vm._v(" "),
                        item.status == "PENDING"
                          ? _c("div", [
                              _c("span", { staticClass: "tag is-warning" }, [
                                _vm._v(
                                  "\n                                    " +
                                    _vm._s(item.status) +
                                    "\n                                 "
                                ),
                              ]),
                            ])
                          : _vm._e(),
                        _vm._v(" "),
                        item.status == "REJECTED"
                          ? _c(
                              "div",
                              [
                                _c("span", { staticClass: "tag is-danger" }, [
                                  _vm._v(
                                    "\n                                    " +
                                      _vm._s(item.status) +
                                      "\n                                 "
                                  ),
                                ]),
                                _vm._v(" "),
                                _c(
                                  "b-button",
                                  {
                                    attrs: {
                                      size: "is-small",
                                      type: "is-info is-success",
                                    },
                                    on: {
                                      click: function ($event) {
                                        return _vm.retryPayment(
                                          item.id_purchase_order
                                        )
                                      },
                                    },
                                  },
                                  [_vm._v("Re try payment")]
                                ),
                              ],
                              1
                            )
                          : _vm._e(),
                      ]),
                      _vm._v(" "),
                      _c("td", [
                        _vm._v("Date : " + _vm._s(item.crated_formatted)),
                      ]),
                      _vm._v(" "),
                      _c("td"),
                      _vm._v(" "),
                      _c("td"),
                    ])
                  }
                )
              },
            },
          ]),
        },
        [
          _c("b-table-column", {
            attrs: {
              field: "name",
              label: _vm.columnsVisible["reference"].title,
              width: "300",
              sortable: "",
            },
            scopedSlots: _vm._u([
              {
                key: "default",
                fn: function (props) {
                  return [
                    _vm.showDetailIcon
                      ? [
                          _vm._v(
                            "\n                " +
                              _vm._s(props.row.data.id) +
                              "\n            "
                          ),
                        ]
                      : [
                          _c(
                            "a",
                            {
                              on: {
                                click: function ($event) {
                                  return _vm.toggle(props.row)
                                },
                              },
                            },
                            [
                              _vm._v(
                                "\n                    " +
                                  _vm._s(props.row.data.id) +
                                  "\n                "
                              ),
                            ]
                          ),
                        ],
                  ]
                },
              },
            ]),
          }),
          _vm._v(" "),
          _c("b-table-column", {
            attrs: {
              field: "sold",
              label: _vm.columnsVisible["quantity"].title,
              sortable: "",
              centered: "",
            },
            scopedSlots: _vm._u([
              {
                key: "default",
                fn: function (props) {
                  return [
                    _vm._v(
                      "\n            " +
                        _vm._s(props.row.data.qty) +
                        "\n        "
                    ),
                  ]
                },
              },
            ]),
          }),
          _vm._v(" "),
          _c("b-table-column", {
            attrs: {
              field: "available",
              label: _vm.columnsVisible["total"].title,
              sortable: "",
              centered: "",
            },
            scopedSlots: _vm._u([
              {
                key: "default",
                fn: function (props) {
                  return [
                    _vm._v(
                      "\n            " +
                        _vm._s(props.row.data.total) +
                        "\n        "
                    ),
                  ]
                },
              },
            ]),
          }),
          _vm._v(" "),
          _c("b-table-column", {
            attrs: {
              field: "available",
              label: _vm.columnsVisible["created"].title,
              sortable: "",
              centered: "",
            },
            scopedSlots: _vm._u([
              {
                key: "default",
                fn: function (props) {
                  return [
                    _vm._v(
                      "\n            " +
                        _vm._s(props.row.data.crated_formatted) +
                        "\n        "
                    ),
                  ]
                },
              },
            ]),
          }),
          _vm._v(" "),
          _c("b-table-column", {
            attrs: {
              field: "available",
              label: _vm.columnsVisible["detail"].title,
              sortable: "",
              centered: "",
            },
            scopedSlots: _vm._u([
              {
                key: "default",
                fn: function (props) {
                  return [
                    _c("b-button", { attrs: { type: "is-info is-light" } }, [
                      _vm._v("View detail"),
                    ]),
                  ]
                },
              },
            ]),
          }),
        ],
        1
      ),
    ],
    1
  )
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