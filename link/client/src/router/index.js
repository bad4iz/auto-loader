import Vue from 'vue'
import Router from 'vue-router'
import Admin from '@/components/pages/Admin'
import Index from '@/components/pages/Index'
import Dark from '@/components/pages/Dark'

import Vuetify from 'vuetify'

Vue.use(Vuetify)
Vue.use(Router)

export default new Router({
  routes: [{
    path: '/',
    name: 'Index',
    component: Index
  },
  {
    path: '/admin',
    name: 'Admin',
    component: Admin
  },
  {
    path: '/dark',
    name: 'Dark',
    component: Dark
  }]
})
