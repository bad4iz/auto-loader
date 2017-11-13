<template>
  <v-card>
    <v-card-title>
      logistics
      <v-spacer></v-spacer>
      <v-text-field
        append-icon="search"
        label="Search"
        single-line
        hide-details
        v-model="search"
      ></v-text-field>
    </v-card-title>
    <v-data-table
        v-bind:headers="headers"
        v-bind:items="this.$store.getters.logistics"
        v-bind:search="search"
        pagination.sync
      >
      <template slot="items" slot-scope="props">
        <td class="text-xs-right">{{ props.item.keyFile }}</td>
        <td class="text-xs-right">{{ props.item.diskription }}</td>
        <td class="text-xs">{{ props.item.db }}</td>
        <td class="text-xs">{{ props.item.tableBd }}</td>
        <td class="text-xs">{{ props.item.struct }}</td>
        <td class="text-xs">{{ props.item.statusbd }}</td>
      </template>
      <template slot="pageText" slot-scope="{ pageStart, pageStop }">
        от {{ pageStart }} до {{ pageStop }}
      </template>
    </v-data-table>
  </v-card>
</template>

<script>
  // import timeConverter from '../../libs/timeConverter'
  export default {
    data () {
      return {
        idKey: 1,
        tmp: '',
        search: '',
        pagination: {
          page: 2,
          rowsPerPage: 10,
          sync: {
            page: 2,
            rowsPerPage: 10
          }
        },
        headers: [
          { text: 'Ключ', value: 'keyFile' },
          { text: 'Описание', value: 'diskription' },
          { text: 'База данных', align: 'center', value: 'db' },
          { text: 'Таблица', align: 'center', value: 'tableBd' },
          { text: 'Структура', align: 'center', value: 'struct' },
          { text: 'Таблица созадна', align: 'center', value: 'statusbd' }
        ],
        item: []
      }
    },
    created: function () {
      this.$store.dispatch('logisticsInit')
    }
  }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
