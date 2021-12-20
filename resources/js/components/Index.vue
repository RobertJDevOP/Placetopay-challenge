
<template>
<div>

    <div class="columns">
        <div class="column is-10">
            <h1 class="title">Welcome to our awesome market</h1>
        </div>
        <div class="column">
            <button @click="openModalShoppingCart()"  class="button is-medium is-black"> <span class="icon is-large"><i class="mdi mdi-cart-variant"></i></span><span v-text="this.$store.state.cart.length"></span> &nbsp; Cart</button>
        </div>
    </div>

    <b-collapse class="card" animation="slide"  v-cloak>
        <template #trigger="props">
            <div
                class="card-header"
                role="button">
                <p class="card-header-title">Filters</p>
                <a class="card-header-icon"><b-icon :icon="props.open ? 'menu-down' : 'menu-up'"></b-icon></a>
            </div>
        </template>

        <div class="card-content">
        <div class="columns">
            <div class="column is-4">
                <label class="label">Find by Category</label>
                    <div class="select">
                        <select>
                            <option>Select the product category</option>
                            <option>------------</option>
                        </select>
                    </div>
            </div>
            <div class="column is-4">
                <label class="label">Find by name of the product</label>
                    <input class="input" type="text" placeholder="Name of the product">
            </div>
            <div class="column is-4">
                    <b-field label="Find by prince range">
                        <b-slider v-model="value"></b-slider>
                    </b-field>
            </div>
        </div>

            <b-button type="is-link" native-type="submit" icon-left="magnify">Clear</b-button>
                <b-button tag="a" type="is-link" href="" icon-left="eraser">Search</b-button>
        </div>
    </b-collapse>
    <hr>

    <div class="columns is-multiline">
        <div v-for="product in products.data" :key="product.id" class="column is-one-third">

            <div class="card">
                <div class="card-image">
                    <figure class="image is-4by3">
                            <img v-bind:src="product.image" />
                    </figure>
                </div>
                <div class="card-content">
                    <div class="media">
                        <div class="media-content">
                            <p class="title is-4">{{product.product_name }}</p>
                            <p class="subtitle is-6"></p>
                        </div>
                        <div class="media-right">
                            <b-button @click="$store.commit('addProductToCart', product)" rounded  type="is-dark" size="is-large" icon-right="cart-variant" />
                        </div>
                    </div>

                    <div class="content">
                        $ {{product.list_price}}
                    </div>
                </div>
            </div>
        </div>
    </div>






    <nav class="pagination is-centered" role="navigation" aria-label="pagination">
        <span class="pagination-ellipsis">&hellip;</span>
        <ul class="pagination-list">
            <li v-for="page in products.links" >

            <div v-if="page.label =='...'">
                <span class="pagination-ellipsis">&hellip;</span>
            </div>
            <div v-else>
                    <div v-if="page.label == products.current_page">
                            <a @click="getProducts(page.label)" class="pagination-link is-current" >{{page.label}}</a>
                    </div>
                    <div v-else>
                            <div v-if="page.label =='pagination.previous'">
                            </div>
                            <div v-else-if="page.label =='pagination.next'">
                            </div>
                            <div v-else>
                                <a @click="getProducts(page.label)" class="pagination-link" >{{page.label}}</a>
                            </div>
                    </div>
            </div>

            </li>
        </ul>
    </nav>





    <b-modal v-model="modalShoppingCart" :width="1280" scroll="keep">
        <header class="modal-card-head">
            <p class="modal-card-title">Shopping Cart</p>

        </header>
        <div class="card">
            <div class="card-content">
                <div class="content">
                    <p class="title is-4">{{totalProduct}}Products in your cart</p>


                    <div v-for="(product, index) in getCart" :key="index" class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5">

                        <div class="box">

                            <div class="media">
                                <div class="media-left">
                                    <figure class="image is-48x48">
                                        <img v-bind:src="product.image" />
                                    </figure>
                                </div>

                            </div>

                            {{ product.product_name }}
                            Precio : {{ product.list_price  }}
                            Cantidad  : {{ product.qty  }}
                            Total :{{ (product.list_price * product.qty)  }}
                            <a href="#" @click="$store.commit('removeProductToCart', index)" class="font-semibold hover:text-red-500 text-gray-500 text-xs">Eliminar del carrito</a>

                        </div>

                    </div>

                    Informations  Total price
                    <span>{{ totalPrice  }} $</span>

                    <b-button @click="openModalUserDataConfirmation()" type="is-dark">Payment</b-button>
                </div>
            </div>
        </div>
    </b-modal>


    <b-modal v-model="modalUserDataConfirmation" :width="1280" scroll="keep">
        <header class="modal-card-head">
            <p class="modal-card-title">Payment </p>
        </header>
        <div class="card">
            <div class="card-content">
                <div class="content">
                    <p class="title is-4">Please check if the data is correct, if not you can update your data</p>

                    <div class="columns">
                        <div class="column is-5">
                            <b-field label='Names'>
                                <b-input type="text" name="name" v-bind:value="getUser.name"  maxlength="255" ></b-input>
                            </b-field>
                        </div>
                        <div class="column is-4">
                            <b-field label='Surnames'>
                                <b-input type="text" name="surnames" v-bind:value="getUser.surnames"  maxlength="255" ></b-input>
                            </b-field>
                        </div>
                        <div class="column is-3">
                            <label class="label">Document type</label>
                            <div class="select">
                                <select>
                                    <option v-for="(option, index) in options " v-bind:value="option.id" :selected="index == getUser.document_type">{{ option }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="columns">
                        <div class="column is-2">
                            <b-field label='Document number'>
                                <b-input type="number" v-bind:value="getUser.number_document" name="number_document" maxlength="255" ></b-input>
                            </b-field>
                        </div>
                        <div class="column is-2">
                            <b-field label='Email'>
                                <b-input type="email" name="email" v-bind:value="getUser.email"  maxlength="255" ></b-input>
                            </b-field>
                        </div>
                        <div class="column is-2">
                            <b-field label='Cell phone'>
                                <b-input type="number" name="cell_phone" v-bind:value="getUser.cell_phone"   maxlength="255" ></b-input>
                            </b-field>
                        </div>
                        <div class="column is-6">
                            <b-field label='Residence address'>
                                <b-input type="text" name="user_street"  v-bind:value="getUser.user_street" maxlength="255" ></b-input>
                            </b-field>
                        </div>
                    </div>


                    <b-button @click="confirmPayment()" type="is-dark">Confirm and pay</b-button>

                </div>
            </div>
        </div>
    </b-modal>




</div>
</template>


<script>
let user = document.head.querySelector('meta[name="user"]');


export default {

    data() {
        return {
            modalShoppingCart: false,
            modalUserDataConfirmation: false,
            value: 5,
            options:{
                'CC':'CC-Cédula de ciudadanía',
                'CE':'CE-Cédula de extranjería',
                'TI':'TI-Tarjeta de identidad',
                'NIT':'NIT-Número de Identificación',
                'RUT':'RUT-Registro único tributario'
            },
        }
    },
    created() {
        this.$store.dispatch('getProducts');
    },
    computed: {
        products() {
            return this.$store.state.products;
        },
        getUser(){
            return  JSON.parse(user.content);
        },
        getCart() {
            return this.$store.state.cart;
        },
        totalProduct() {
            return this.$store.state.cart.reduce((acc, current) => acc + current.qty, 0);
        },
        totalPrice() {
            return this.$store.state.cart.reduce((acc, current) => acc + current.list_price * current.qty, 0);
        },

    },
    methods:{
        openModalShoppingCart(){
            /*let  idHelp = {id:100000}
            this.$store.commit('addProductToCart', idHelp)
            this.$store.commit('removeProductToCart', this.$store.state.cart.length-1)*/
            this.modalShoppingCart=true
        },
        getProducts (page){

            this.$store.dispatch('getProducts',{page:page});
        },
        openModalUserDataConfirmation(){
            // HACER VALIDACIONES RESPECTIVAS A LA CANTIDAD DEL CARRITO DE COMPRAS JEJE y demas
            // cierro el modal----
            this.modalShoppingCart=false;
            this.modalUserDataConfirmation= true;
        },
        confirmPayment(){
          // FAVOR VALIDAR DATOS ANTES DE PROCESAR..........
            let productsPayment =  this.$store.state.cart;
            let totalPrice =  this.totalPrice;
            let totalProduct =  this.totalProduct;
            axios.post('/storeShoppingCart', { productsPayment,totalProduct,totalPrice}, { }
                )
                .then((response) => {
                    console.log(response);
                })
                .catch((error) => console.error(error))
        }
    }

}
</script>

