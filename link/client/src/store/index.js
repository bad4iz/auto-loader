import Vue from 'vue'
import Vuex from 'vuex'
import timeConverter from '../libs/timeConverter'

Vue.use(Vuex)

const store = new Vuex.Store({
  state: {
    noLogisticsTable: [],
    logisticsTable: []
  },
  getters: {
    noLogistics (state) {
      return state.noLogisticsTable
    },
    logistics (state) {
      return state.logisticsTable
    },
    noLogisticsCount (state) {
      return state.noLogisticsTable.length
    }
  },
  mutations: {
    set (state, {type, item}) {
      state[type] = item
    }
  },
  actions: {
    noLogisticsInit ({commit}) {
      const url = 'http://auto-loader.dev/load/getNoLogistic'
      fetch(url)
        .then(function (response) {
          return response.json()
        })
        .then(function (response) {
          const tmp = []
          response.forEach(function (element) {
            tmp.push(Object.assign(element, {time: timeConverter(element.date)}))
          })
          commit('set', {type: 'noLogisticsTable', item: response})
        })
    },
    logisticsInit ({commit}) {
      const url = 'http://auto-loader.dev/load/getLogistic'
      fetch(url)
        .then(function (response) {
          return response.json()
        })
        .then(function (response) {
          const tmp = []
          response.forEach(function (element) {
            tmp.push(Object.assign(element, {time: timeConverter(element.date)}))
          })
          commit('set', {type: 'logisticsTable', item: response})
        })
    },
    setLogistic ({commit}, data) {
      const url = 'http://auto-loader.dev/load/setLogistic'
      const that = this
      fetch(url, {
        method: 'POST',
        body: data
      })
      .then(function () {
        that.dispatch('noLogisticsInit')
        that.dispatch('logisticsInit')
      })
    }
  }
})

export default store
