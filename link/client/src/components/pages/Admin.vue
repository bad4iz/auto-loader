<template>
  <div>
    <h2>Админка</h2>
    <create-db></create-db>
  </div>
</template>



<script>
import createDb from '../components/createDb'
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
  },
  components: {
    createDb
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
