<template>
    <div>
        <button class="btn btn-danger btn-sm remove-from-cart" @click="deleteItem()" ><i class="fa fa-trash-o"></i></button>
    </div>
</template>
<script>
export default {
    props:{
        'id': String,
    },
    methods: {
        /**
         * Sends post request to remove an item from cart collection
         */
        deleteItem(){
            if(confirm("Are you sure")) {
                axios.post('remove-from-cart', {id: this.id})
                    .then(res => this.$root.$emit('result-remove', res.data))
                    .catch(error => {});
            }
           
        }
    },
}
</script>