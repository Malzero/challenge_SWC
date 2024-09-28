import Vue from 'vue'
import PortalVue from 'portal-vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import App from './App.vue'
import axios from 'axios'
import VueAxios from 'vue-axios'


//import './assets/main.css'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(PortalVue)
Vue.use(VueAxios, axios)

new Vue({
  render: (h) => h(App)
}).$mount('#app')
