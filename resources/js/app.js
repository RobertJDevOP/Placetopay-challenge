import Vue from 'vue';
import Vuex from 'vuex';
import  Index from './components/Index'


require('./bootstrap');
require('./buefy')

Vue.use(Vuex);

Vue.component('Index', Index)



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
                state.cart[duplicatedProductIndex].qty++;
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
            if (typeof page !== 'undefined'){
                pageAux =  page.page
            }else{
                 pageAux = this.currentPage;
            }
            axios.get('/api/products?page='+pageAux)
                .then((response) => {
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
