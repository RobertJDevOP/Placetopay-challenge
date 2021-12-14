
<template>
<div>


    <div class="columns">
        <div class="column is-10">
            <h1 class="title">Welcome to our awesome market</h1>
        </div>
        <div class="column">
            <button  @click="isImageModalActive = true"  class="button is-medium is-black"> <span class="icon is-large"><i class="mdi mdi-cart-variant"></i></span><span v-text="this.$store.state.cart.length"></span> &nbsp; Cart</button>
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
                            <img v-bind:src="product.url_product_img" />
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




    <b-modal v-model="isImageModalActive" :width="1280" scroll="keep">
        <div class="card">
            <div class="card-content">
                <div class="content">
                    <Shoppingcart></Shoppingcart>
                </div>
            </div>
        </div>
    </b-modal>


</div>
</template>


<script>

export default {
    data() {
        return {
            isImageModalActive: false,
            value: 5
        }
    },
    created() {
        this.$store.dispatch('getProducts');
    },
    computed: {
        products() {
            return this.$store.state.products;
        },
    },
    methods:{
        getProducts (page){
            this.$store.dispatch('getProducts',{page:page});
        }
    }

}
</script>

