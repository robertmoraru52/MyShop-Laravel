<template>
    <div>
        <div class="form-group">
            <select
                multiple="multiple"
                style="height: 100%"
                class=""
                id="select-cat" v-model="catsProduct">
                <option v-for="cat in categories" :key="cat.id" :value="cat.id" @click="updateCategory(cat.id)"> {{cat.name}} </option>
            </select>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        products: [],
        categories: [],
        id: [],
    },
    data() {
        return {
            catsProduct: [],
        };
    },
    mounted() {
        this.existsInProduct();
    },
    methods: {
        /**
         * Send post request to AdminController To change the category selected
         */
        updateCategory(idCat){
             axios.post('change-category-admin', { prodId:this.id, idCat:idCat })
                .then(res =>{
                    for(var i = 0; i< res.data.length; i++){
                        if(this.categories[i].id == res.data[i].pivot.category_id){
                            this.catsProduct.push(res.data[i].pivot.category_id);
                        }
                    }
                } )
                .catch(error => {});
        },
        /**
         * Shows the categories that a product has
         */
        existsInProduct(){
                for(var i = 0; i< this.categories.length; i++){
                    for(var j = 0; j< this.products.categories.length; j++){
                        if(this.categories[i].id == this.products.categories[j].id){
                                this.catsProduct.push(this.products.categories[j].id);
                    }
                }   
                }
        }
    },
};
</script>
