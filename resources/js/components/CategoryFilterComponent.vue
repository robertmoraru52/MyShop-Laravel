<template>
    <div>
        <div class="collapse" id="collapse2">
            <ul class="list-unstyled ms-3" id="cat_nav">
                <div v-for="categoryList in categories" :key="categoryList.id">
                    <li><button class='dropdown-item' @click="filterCategories(categoryList.id)">{{categoryList.name}}</button></li>
                </div>
            </ul>
        </div>
    </div>
</template>
<script>
export default {
     props:{
        'categories': [],
    },
    methods: {
        /**
         * filter products on homepage by clicked category
         */
        filterCategories(id){
             axios.post('category-filter', {id: id})
                .then( res=> this.$root.$emit('result-filter', res.data))
                .catch(error => {
                    console.log(error);
                });
        }
    },
}
</script>