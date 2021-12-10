<template>
    <div>
         <input type="number" min="1" max="quantity" v-model="qCart" :placeholder="quantity" class="form-control quantity" />
    </div>
</template>
<script>
export default {
    props:{
        'id': String,
        'quantity': String,
    },
    data() {
        return {
            qCart: Number,
        };
    },
     watch:{
         /**
          * Emits event with the updated values to parent component and total component
          */
        qCart: function(e){
            if(e>0){
                axios.post('update-cart', {id: this.id, quantity: e})
                    .then(res => this.$root.$emit('result-update', res.data))
                    .catch(error => {});
            }
        }
    },
}
</script>