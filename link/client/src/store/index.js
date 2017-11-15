import Vue from 'vue'
import Vuex from 'vuex'
import timeConverter from '../libs/timeConverter'

Vue.use(Vuex)

const store = new Vuex.Store({
  state: {
    noLogisticsTable: [],
    logisticsTable: [],
    base: []
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
    },
    getBase (state) {
      return state.base
    }
  },
  mutations: {
    set (state, {type, item}) {
      state[type] = item
    }
  },
  actions: {
    noLogisticsInit ({commit}) {
      const url = 'load/getNoLogistic'
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
      const url = 'load/getLogistic'
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
      const url = 'load/setLogistic'
      const that = this
      fetch(url, {
        method: 'POST',
        body: data
      })
      .then(function () {
        that.dispatch('noLogisticsInit')
        that.dispatch('logisticsInit')
      })
    },
    setDataBase ({commit}, data) {
      const url = 'load/setDataBase'
      fetch(url, {
        method: 'POST',
        body: data
      })
      .then(function (response) {
        return response.json()
      })
      .then(function (response) {
        console.log(response)
        commit('set', {type: 'base', item: response})
      })
    },
    getDataBase ({commit}) {
      const url = 'load/getDataBase'
      fetch(url)
      .then(function (response) {
        return response.json()
      })
      .then(function (response) {
        console.log(response)
        commit('set', {type: 'base', item: response})
      })
    }
  }
})

export default store
