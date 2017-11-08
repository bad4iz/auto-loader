<template>
  <v-toolbar
      color="red"
      dark
      app
      clipped-left
      fixed
    >
      <v-toolbar-title style="width: 300px" class="ml-0 pl-3">
        <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
        Таблицы Базы Данных
      </v-toolbar-title>
      <v-spacer></v-spacer>
       <v-layout row  style="max-width: 650px">
        <v-text-field
          placeholder="Search..."
          single-line
          append-icon="search"
          :append-icon-cb="() => {}"
          class="white--text"
          hide-details
        ></v-text-field>
      </v-layout>
      <v-spacer></v-spacer>
      <v-btn icon>
        <v-icon>apps</v-icon>
      </v-btn>
      <v-btn icon>
        <v-icon>notifications</v-icon>
      </v-btn>
      <v-btn icon  standard>
        <v-avatar size="32px" tile>
          <img
            src="../../assets/logo.png"
            alt="FJV"
            title="FJV"
          >
        </v-avatar>
      </v-btn>
    </v-toolbar>
</template>

<script>
  export default{
    name: 'navigation-drawer',
    data () {
      return {
        name: 'страница администрирования бд'
      }
    }
  }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
