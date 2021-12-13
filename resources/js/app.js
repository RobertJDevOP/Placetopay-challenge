import Vue from 'vue';
import Vuex from 'vuex';
import  Components from './components/Index'
require('./bootstrap');
require('./buefy')

Vue.use(Vuex);
Vue.component('Index', Components)


const store = new Vuex.Store({
    state: {
        cart: [],
        products: [],
        pages : 1,
        currentPage: 1
    },

    mutations: {
        setProducts(state, products) {
            state.products = products;
        },
        setCurrentPage(state, currentPage) {
            state.currentPage = currentPage;
        },
        addProductToCart(state, product) {

           // console.log("llegue aca con el producto"+product.product_name)
            const duplicatedProductIndex = state.cart.findIndex(item => item.id === product.id);

            if (duplicatedProductIndex !== -1) {
                state.cart[duplicatedProductIndex].qty++;
                return;
            }

            product.qty = 1;
            state.cart.push(product);
        },
        removeProductToCart(state, index) {
            state.cart.splice(index, 1);
        },
    },

    actions: {
        getProducts({ commit } ,page) {

            let pageAux = ''

            if (typeof page !== 'undefined'){
                pageAux =  page.page
            }else{
                 pageAux = this.currentPage;
            }

         //   axios.get('/api/products?page='+pageAux)
            axios.get('/api/products?page='+pageAux)
                .then((response) => {
                    this.state.pages=response.data.last_page
                    //this.state.currentPage=response.data.current_page
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
