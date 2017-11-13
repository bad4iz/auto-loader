<template>
  <v-card>
    <v-card-title>
      noLogistics
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
        v-bind:items="this.$store.getters.noLogistics"
        v-bind:search="search"
      >
      <template slot="items" slot-scope="props">
        <td class="text-xs-right">{{ props.item.keyFile }}</td>
        <td class="text-xs">{{ props.item.time }}</td>
      </template>
      <template slot="pageText" slot-scope="{ pageStart, pageStop }">
        From {{ pageStart }} to {{ pageStop }}
      </template>
    </v-data-table>
  </v-card>
</template>



<script>
  // import timeConverter from '../../libs/timeConverter'
  export default {
    data () {
      return {
        tmp: '',
        search: '',
        pagination: {},
        headers: [
          { text: 'Ключ', value: 'keyFile' },
          { text: 'Дата', align: 'center', value: 'date' }
        ],
        item: []
      }
    },
    created: function () {
      this.$store.dispatch('noLogisticsInit')
    }
  }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
