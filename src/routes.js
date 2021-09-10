import Home from './components/Home.vue';
import Team from './components/Team.vue';
import Jogar from './components/Jogar.vue';
import Placar from './components/Placar.vue';

const routes = [
 { path: '/', component: Home },
 { path: '/team', component: Team },
 { path: '/jogar', component: Jogar },
 { path: '/placar', component: Placar},
];

export default routes;