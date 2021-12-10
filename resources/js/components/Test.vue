<template>
    <div>
         <input ref="input" />
         <button @click="focusInput"></button>
    </div>
</template>
<script>
export default {
    methods: {
    focusInput() {
      this.$refs.input.focus();
      console.log(this.$refs.input.value);
    }
  },
  mounted() {
    this.focusInput();
  }
}
</script>