
import Vue from 'vue';
import App from './App.vue';
import VueMeta from 'vue-meta';
import VueRouter from 'vue-router';
import VueMaterial from 'vue-material';
import 'vue-material/dist/vue-material.min.css';
import 'vue-material/dist/theme/default-dark.css';

import routes from './routes';

Vue.use(VueMeta);
Vue.use(VueRouter);
Vue.use(VueMaterial);

new Vue({
 render: h => h(App),
 routes
}).$mount('#app');