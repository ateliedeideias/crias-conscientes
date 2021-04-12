
import Vue from 'vue';
import App from './App.vue';
import VueMeta from 'vue-meta';
import VueMaterial from 'vue-material';
import 'vue-material/dist/vue-material.min.css';
import 'vue-material/dist/theme/default-dark.css';

Vue.use(VueMeta);
Vue.use(VueMaterial);

new Vue({
 render: h => h(App)
}).$mount('#app');