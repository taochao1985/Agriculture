import Vue from 'vue'
import VueResource from 'vue-resource'
import store from './store'
import Multiselect from 'vue-multiselect'
import VueSocketio from 'vue-socket.io'
import 'bootstrap/dist/css/bootstrap.min.css'
import App from './App'
import Logger from './plugins/Logger'
import router from './router'
import * as uiv from 'uiv'
import Vuelidate from 'vuelidate'

Vue.use(Vuelidate)
Vue.use(uiv)
Vue.use(VueResource)
Vue.use(Logger, {loggin: true})
Vue.use(VueSocketio, 'http://localhost:8890')

Vue.component('multiselect', Multiselect)
Vue.component('app', App)

router.beforeEach((to, from, next) => {
  if (to.meta.title) {
    document.title = to.meta.title
  }
  if (to.meta.requiresAuth) {
    const authUser = JSON.parse(window.localStorage.getItem('authUser'))
    if (authUser && authUser.access_token) {
      next()
    } else {
      next({name: 'home'})
    }
  }
  next()
})

Vue.http.interceptors.push((request, next) => {
  next((response) => {
    if (response.status === 401) {
      console.log('Need to login again')
    }
  })
})

new Vue({
  router, store
}).$mount('#app')
// new Vue({
//   el: '#app',
//   router,
//   store,
//   template: '<App/>',
//   components: { App }
// })
