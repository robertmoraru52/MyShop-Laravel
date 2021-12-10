<template>
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xl-4 text-center my-2" v-for="productList in products" :key="productList.id" >
        <div class="card border-0 bg-dark h-100" >
            <img src="css/t-shirt.png" class="img-fluid" alt="t-shirt">
            <div class="card-body">
                <span style="color: white">
                <h5 class="card-title" >{{productList.name}}</h5>
                </span>
                <span style="color: white">
                    <p class="card-text">{{productList.name}}</p>
                </span>
                <star-rating :value="productList.stars" :id="productList.id"></star-rating>
                <p class="text-white" id="ratings"></p>
                <span style="color: rgb(240, 43, 48);">
                    <h6>{{productList.price}} Lei</h6>
                </span>
            </div>
            <a :href="'details/' + productList.id" class='btn btn-success mb-3'>See More Details</a>
        </div>
    </div>   
</div>   
</template>

<script>
import StarRating from './StarRating.vue'

export default {
    components: {
    StarRating
    },
    data() {
        return {
            products: [],
            value: Number,
        };
    },
    /**
     * Repopulates products collection on the event listener
     */
    mounted() {
        this.$root.$on('result-search', (data) => {
             this.products = data.data ;
        });
        this.$root.$on('result-rating', (data) => {
             this.products = data.data ;
        });
    },
    created() {
        this.getResults();
    },
    
    methods: {
        /**
         * Fetches from controller products collection
         */
        getResults() {
           fetch('homepage-products')
            .then(res => res.json())
            .then(res => {
                this.products = res.data;
            })
        },
}
}
</script>