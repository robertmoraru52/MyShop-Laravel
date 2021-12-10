<style>
.star-rating__checkbox {
  position: absolute;
  overflow: hidden;
  clip: rect(0 0 0 0);
  height: 1px;
  width: 1px;
  margin: -1px;
  padding: 0;
  border: 0;
}

.star-rating__star {
  display: inline-block;
  padding: 3px;
  vertical-align: middle;
  line-height: 1;
  font-size: 1.5em;
  color: #ababab;
  transition: color 0.2s ease-out;
}
.star-rating__star:hover {
  cursor: pointer;
}
.star-rating__star.is-selected {
  color: #ffd700;
}
.star-rating__star.is-disabled:hover {
  cursor: default;
}
</style>

<template>
        <div class="star-rating">
        <label v-for="rating in ratings" :key="rating" class="star-rating__star" :class="{'is-selected': ((temp_value >= rating) && value != null), 'is-disabled': disabled}" >
        <input class="star-rating star-rating__checkbox" v-on:click="set(rating)" type="radio" :value="temp_value" :name="name" :id="id"
        v-model="temp_value" :disabled="disabled">★</label>
        </div>
</template>

<script>
export default {
    data: function() {
    return {
      temp_value: this.value,
      ratings: [1, 2, 3, 4, 5],
    };
  },
props: {
    'name': String,
    'value': Number,
    'id': Number,
    'disabled': Boolean,
    'required': Boolean
  },
  
  methods: {
    /*
     * Behaviour of the stars on mouseover.
     */
    // star_over: function(index) {

    //   if (!this.disabled) {
    //     this.temp_value = this.value;
    //     return this.value = index;
    //     console.log(this.temp_value);
    //   }
    // },

    /*
     * Behaviour of the stars on mouseout.
     */
    // star_out: function() {

    //   if (!this.disabled) {
    //     return this.value = this.temp_value;
    //   }
    // },

    /*
     * Set the rating.
     */
    set: function(rating) {
            axios.post('rating', {star: rating, id: this.id})
                .then(res => this.$root.$emit('result-rating', res.data))
                .catch(error => {});
    }
  
  }
}
</script>