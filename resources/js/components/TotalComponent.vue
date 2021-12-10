<template>
    <div>
        <p>Total Lei: {{ totalPrice }}</p>
    </div>
</template>
<script>
export default {
    data() {
        return {
            cart: [],
        };
    },
    created() {
        /**
         * Fetches the cart collection from controller
         */
        fetch('cart-collection')
        .then(res => res.json())
        .then(res => {
            this.cart = res;
        });
    },
    mounted() {
        /**
         * Updates the total price on price update event listener
         */
        this.$root.$on('result-update', (data) => {
             this.cart = data ;
        });
    },
    computed: {
        /**
         * Total price
         */
        totalPrice: function () {
            let total = 0;
            for (const key in this.cart) {
                total += (this.cart[key].quantity * this.cart[key].price);
            }

            return total;
        }
    },
}
</script>