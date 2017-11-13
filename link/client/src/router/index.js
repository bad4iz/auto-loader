import Vue from 'vue'
import Router from 'vue-router'
import Admin from '@/components/pages/Admin'
import Index from '@/components/pages/Index'
import noLogistic from '@/components/pages/NoLogistic'
import logistic from '@/components/pages/Logistic'

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
    path: '/noLogistic',
    name: 'NoLogistic',
    component: noLogistic
  },
  {
    path: '/logistic',
    name: 'logistic',
    component: logistic
  }]
})
