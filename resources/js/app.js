import Vue from 'vue';
import Vuex from 'vuex';
import Index from './components/Index'
import Table from './components/TablePurchaseOrder'
import TableReports from './components/Reportsgeneratetable'
import Echo from 'laravel-echo'


window.Pusher = require('pusher-js')
require('./bootstrap');
require('./buefy')


Vue.use(Vuex);
Vue.component('Index', Index)
Vue.component('Purchaseorder', Table)
Vue.component('Reportsgeneratetable', TableReports)

/*
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    wsHost: window.location.hostname,
    wsPort: 6001,
    disableStats: true,
    forceTLS: false,
})
*/

const store = new Vuex.Store({

    state: {
        cart: [],
        products: [],
        dataUserAuth: {},
        pages : 1,
        currentPage: 1,
        isImageModalActive: false,
        isModalUserDataConf: false,
    },

    mutations: {

        setProducts(state, products) {
            state.products = products;
        },
        setCurrentPage(state, currentPage) {
            state.currentPage = currentPage;
        },
        addProductToCart(state, product) {

            const duplicatedProductIndex = state.cart.findIndex(item => item.id === product.id);

            console.log(duplicatedProductIndex);
            if (duplicatedProductIndex !== -1) {
                //let increment =
                let item = state.cart[duplicatedProductIndex];
                item.qty++;
                // propiedad reactiva el array no lo era entonces toca ASI XDD lo agrego
                Vue.set(state.cart, duplicatedProductIndex, item)
                return;
            }
            product.qty = 1;
            state.cart.push(product);
        },
        removeProductToCart(state, index) {
            state.cart.splice(index, 1);
        },
        totalPrice() {
          return false;
        }
    },
    actions: {
        getProducts({ commit } ,page) {

           let pageAux = ''
           const params = new URLSearchParams();

            if (typeof page !== 'undefined'){
                pageAux =  page.page
                params.append('product_name',  page.filters[0].findByNameOfProduct);
                params.append('category',page.filters[0].findByCategory);
                params.append('range_price',page.filters[0].findByPriceRange);
            }else{
                 pageAux = this.currentPage;
            }

            axios.get('/api/products?page='+pageAux, {
                params  :params
            }).then((response) => {
                    this.state.pages=response.data.last_page
                    commit('setCurrentPage',response.data.current_page)
                    commit('setProducts', response.data)
                })
                .catch((error) => console.error(error))
        },
    },

});


const app = new Vue({
    store,
    el: '#app',
})
