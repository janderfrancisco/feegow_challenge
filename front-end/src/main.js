import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import loader from "vue-ui-preloader" 
import VueResource from 'vue-resource'
import VueTheMask from 'vue-the-mask'
import VueSweetalert2 from 'vue-sweetalert2';


// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue);
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin);
Vue.use(loader);
Vue.use(VueResource);
Vue.use(VueTheMask);
Vue.use(VueSweetalert2);


Vue.config.productionTip = false
 
new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')

