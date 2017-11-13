<template>
<div>
    <h1>Logistic</h1>
    <logistics-table></logistics-table>

      <v-btn
      fab
      bottom
      right
      color="pink"
      dark
      fixed
      @click.stop="dialog = !dialog"
    >
      <v-icon>add</v-icon>
    </v-btn>

<v-dialog v-model="dialog" width="800px">
      <v-card>
        <v-card-title
          class="blue lighten-4 py-4 title"
        >
          Create contact
        </v-card-title>
        <v-container grid-list-sm class="pa-4">
          <v-layout row wrap>

              <v-flex xs12>
                <v-select
                v-bind:items="keyNoLogistics()"
                v-model="keyFile"
                label="Ключ"
                single-line
                bottom
              ></v-select>
            </v-flex>

            <v-flex xs12>
              <v-text-field
                prepend-icon="description"
                placeholder="Описание"
                v-model="diskription"
              ></v-text-field>
            </v-flex>
            
            <v-flex xs6>
              <v-text-field
                prepend-icon="dns"
                placeholder="База данных"
                v-model="db"
              ></v-text-field>
            </v-flex>
            
            <v-flex xs6>
              <v-text-field
                prepend-icon="dns"
                placeholder="Таблица"
                v-model="tableBd"
              ></v-text-field>
            </v-flex>
            
            <v-flex xs12>
              <v-text-field
                prepend-icon="dns"
                placeholder="Структура таблицы разделенная ;"
                v-model="struct"
              ></v-text-field>
            </v-flex>

          </v-layout>
        </v-container>
        <v-card-actions>
          <v-btn flat color="primary">More</v-btn>
          <v-spacer></v-spacer>
          <v-btn flat color="primary" @click="cancel">Cancel</v-btn>
          <v-btn flat @click="save">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

</div>
</template>

<script>
  import logisticsTable from '../components/logisticTable.vue'
  export default {
    data: () => ({
      dialog: false,
      keyFile: '',
      db: '',
      tableBd: '',
      struct: '',
      diskription: ''

    }),
    components: {
      logisticsTable
    },
    methods: {
      cancel () {
        this.keyFile = ''
        this.db = ''
        this.tableBd = ''
        this.struct = ''
        this.diskription = ''

        this.dialog = false
      },
      keyNoLogistics () {
        const tmp = []
        this.$store.getters.noLogistics.forEach(item => {
          tmp.push(item.keyFile)
        })
        return tmp
      },
      save () {
        let data = new FormData()
        data.append('keyFile', this.keyFile)
        data.append('db', this.db)
        data.append('tableBd', this.tableBd)
        data.append('struct', this.struct)
        data.append('diskription', this.diskription)
  
        this.$store.dispatch('setLogistic', data)
        this.cancel()
      }
    }
  }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
