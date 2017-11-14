<template>
   <v-card color="grey" flat style="min-width:500px">
      <v-toolbar color="grey darken-1" dark>
        <v-toolbar-side-icon></v-toolbar-side-icon>
          Базы данных
      </v-toolbar>
    <main>
      <v-container
        fluid
        style="min-height: 0;"
        grid-list-lg
      >
       <v-card>
         <v-btn
              color="pink"
              dark
              small
              absolute
              bottom
              right
              fab
              @click="addDataBase"
            >
              <v-icon>add</v-icon>
            </v-btn>
          <v-layout row>
          <v-flex xs4>
            <v-subheader>Создание базы данных</v-subheader>
          </v-flex>
          <v-flex xs8>
            <v-text-field
                  label="База данных"
                  v-model= "base"
                  :rules="nameRules"
            ></v-text-field>
          </v-flex>
        </v-layout>
        </v-card>
        </v-container>
             <v-container
      >
        <v-card>
          <v-list two-line subheader>
            <v-divider inset></v-divider>
            <v-subheader inset>Список баз данных</v-subheader>
            <v-list-tile v-for="(item, index) in baseTable()" v-bind:key="index" avatar>
              <v-list-tile-avatar>
                <v-icon class="grey lighten-1 white--text">folder</v-icon>
              </v-list-tile-avatar>
              <v-list-tile-content>
                <v-list-tile-title>{{ item.name }}</v-list-tile-title>
                <v-list-tile-sub-title>{{ item.crdate }}</v-list-tile-sub-title>
              </v-list-tile-content>
            </v-list-tile>
          </v-list>
        </v-card>

        </v-container>
    </main>
    </v-card>
</template>

<script>
  // import timeConverter from '../../libs/timeConverter'
  export default {
    data () {
      return {
        base: '',
        nameRules: [
          (v) => !!v || 'не может быть пустым',
          (v) => { return /^[a-zA-Z]*(_Rivg)+$/.test(v) || 'не валидное имя базы данных. пример "test_Rivg" _Rivg в конце обязательно' }
        ]
      }
    },
    created: function () {
      this.$store.dispatch('getDataBase')
      console.log(this.base)
    },
    methods: {
      addDataBase () {
        let data = new FormData()
        data.append('base', this.base)
        this.$store.dispatch('setDataBase', data)
        this.base = ''
      },
      baseTable () {
        return this.$store.getters.getBase
      }
    }
  }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
