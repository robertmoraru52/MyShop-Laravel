<template>
    <div class="d-flex align-items-center w-100 h-100 ps-lg-0 ps-sm-3">
        <input class=" ps-md-0 ps-3 bg-transparent " type="text" v-model="suggestion">
         <button class="btn btn-primary d-flex align-items-center justify-content-center" @click="submitSearch" name="submit_search"><i class="fas fa-search"></i></button>
        <ul v-if="Products.length > 0">
            <li v-for="product in Products" :key="product.id" v-text="product.name" @click="setResult(product.name)"></li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            suggestion: null,
            Products: [],
        };
    },
    watch: {
        suggestion(after, before) {
            this.getResults();
        }
    },
    methods: {
        /**
         * Populates Products with the collection from controller
         */
        getResults() {
            axios.post('autocomplete', { suggestion: this.suggestion })
                .then(res => this.Products = res.data)
                .catch(error => {});
        },
        /**
         * Insert the click value in the input
         */
        setResult(result) {
            this.suggestion = result;
            this.Products = [];
        },
        /**
         * Sends the new collection from the search input to ProductsComponent.vue
         */
        submitSearch(){
             axios.post('search', {suggestion: this.suggestion})
                .then( res=> this.$root.$emit('result-search', res.data))
                .catch(error => {});

        },
}}
</script>