import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios'
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'
import '@mdi/font/css/materialdesignicons.css'

axios.defaults.baseURL = 'http://127.0.0.1:8000/api/';
Vue.config.productionTip = false
Vue.use(axios)
Vue.use(Buefy)

require('@/store/subscriber')

store.dispatch('auth/attempt', localStorage.getItem('token')).then(()=>{
  new Vue({
    router,
    store,
    render: h => h(App)
  }).$mount('#app')
});
