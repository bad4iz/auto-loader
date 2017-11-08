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
        v-bind:items="item"
        v-bind:search="search"
      >
      <template slot="items" scope="props">
        <td>
          <v-edit-dialog
            lazy
          > {{ props.item.id }}
            <v-text-field
              slot="input"
              label="Edit"
              single-line
              counter
              :rules="[max25chars]"
            ></v-text-field>
          </v-edit-dialog>
        </td>
        <td class="text-xs-right">{{ props.item.keyFile }}</td>
        <td class="text-xs-right">{{ props.item.time }}</td>
      </template>
      <template slot="pageText" scope="{ pageStart, pageStop }">
        From {{ pageStart }} to {{ pageStop }}
      </template>
    </v-data-table>
  </v-card>
</template>



<script>
  import timeConverter from '../../libs/timeConverter'
  export default {
    data () {
      return {
        max25chars: (v) => v.length <= 25 || 'Input too long!',
        tmp: '',
        search: '',
        pagination: {},
        headers: [
          {
            text: '№',
            align: 'right',
            value: 'id'
          },
          { text: 'Ключ', value: 'keyFile' },
          { text: 'Дата', value: 'date' }
        ],
        item: []
      }
    },
    created: function () {
      let item = this.item
      const url = 'http://auto-loader.dev/load/getNoLogistic'
      fetch(url)
        .then(function (response) {
          return response.json()
        })
        .then(function (response) {
          response.forEach((element) => {
            const el = Object.assign(element, {time: timeConverter(element.date)})
            item.push(el)
          })
        })
    }
  }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
