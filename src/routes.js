import Home from './components/Home.vue';
import Team from './components/Team.vue';
import Jogar from './components/Jogar.vue';

const routes = [
 { path: '/', component: Home },
 { path: '/team', component: Team },
 { path: '/jogar', component: Jogar }
];

export default routes;