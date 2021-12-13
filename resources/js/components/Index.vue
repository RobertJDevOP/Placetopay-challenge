
<template>
<div>
    <h1 class="title">Welcome to our awesome market</h1>

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
                            <b-button rounded  type="is-dark" size="is-large"
                                      icon-right="cart-variant" />
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
                            <a @click="sendRequestForArticles(page.label)" class="pagination-link is-current" >{{page.label}}</a>
                    </div>
                    <div v-else>
                            <div v-if="page.label =='pagination.previous'">
                            </div>
                            <div v-else-if="page.label =='pagination.next'">
                            </div>
                            <div v-else>
                                <a @click="sendRequestForArticles(page.label)" class="pagination-link" >{{page.label}}</a>
                            </div>
                    </div>
            </div>

            </li>
        </ul>
    </nav>



</div>
</template>


<script>

export default {
    created() {
        this.$store.dispatch('getProducts');
    },
    computed: {
        products() {
            return this.$store.state.products;
        },
    },
    methods:{
        sendRequestForArticles (page){
            this.$store.dispatch('getProducts',{page:page});
        }
    }

}
</script>

