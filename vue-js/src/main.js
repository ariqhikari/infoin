import Vue from 'vue'
import App from './App.vue'
import router from './router'
import VueHead from 'vue-head'
import VueLazyload from 'vue-lazyload'
import axios from 'axios'
import AOS from "aos";
import "aos/dist/aos.css";

import VueCountdown from '@chenfengyuan/vue-countdown'
import Toasted from 'vue-toasted';
import VueNumber from 'vue-number-animation'
import VuePageTransition from 'vue-page-transition'

import {
  BootstrapVue,
  BootstrapVueIcons
} from 'bootstrap-vue'

import 'bootstrap-vue/dist/bootstrap-vue.css'
import './assets/css/main.css'

axios.defaults.withCredentials = true

Vue.config.productionTip = false

Vue.component(VueCountdown.name, VueCountdown);
Vue.component('pagination', require('laravel-vue-pagination'));

Vue.use(VueNumber)
Vue.use(Toasted)
Vue.use(VuePageTransition)

Vue.use(BootstrapVue)
Vue.use(BootstrapVueIcons)

Vue.use(VueHead)
Vue.use(VueLazyload)

new Vue({
  created() {
    AOS.init();
  },
  router,
  render: h => h(App)
}).$mount('#app')