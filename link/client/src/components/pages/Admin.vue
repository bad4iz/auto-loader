<template>
  <div>
    <h2>Admin</h2>
    {{ name }}
    <button v-on:click="onClick"> нажми </button>
  </div>
</template>



<script>
export default {
  name: 'AdminPage',
  data () {
    return {
      name: 'страница администрирования бд'
    }
  },
  methods: {
    onClick: function () {
      console.log('click')
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
