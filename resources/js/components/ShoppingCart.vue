
<template>
    <div>


                <p class="title is-4">Shopping Cart</p>
                <p class="subtitle is-6">{{ totalProduct }}Products in your cart</p>

                    <div v-for="(product, index) in getCart" :key="index" class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5">

                        <div class="box">

                            <div class="media">
                                <div class="media-left">
                                    <figure class="image is-48x48">
                                        <img v-bind:src="product.url_product_img" />
                                    </figure>
                                </div>

                            </div>

                            {{ product.product_name }}
                            Precio : {{ product.list_price  }}
                            Cantidad  : {{ product.quantity  }}
                            Total :{{ (product.list_price * product.quantity)  }}
                            <a href="#" @click="$store.commit('removeProductToCart', index)" class="font-semibold hover:text-red-500 text-gray-500 text-xs">Eliminar del carrito</a>

                        </div>

                    </div>

                        Informations  Total price
                            <span>{{ totalPrice  }} $</span>




    </div>
</template>


<script>

export default {

    computed: {
    getCart() {
        return this.$store.state.cart;
    },

    totalProduct() {
        return this.$store.state.cart.reduce((acc, current) => acc + current.quantity, 0);
    },

    totalPrice() {
        return this.$store.state.cart.reduce((acc, current) => acc + current.list_price * current.quantity, 0);
    }
    }

}
</script>

