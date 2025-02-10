import { createRouter, createWebHistory } from 'vue-router';
import IngredientPage from '../assets/IngredientPage.vue';
import RecettePage from '../assets/RecettePage.vue';
import PlatPage from '../assets/PlatPage.vue';
import Statistics from '../assets/Statistics.vue';
import Client from '../assets/Client.vue';
import Commande from '../assets/Commande.vue';



const routes = [
  {
    path: '/ingredients',
    name: 'ingredients',
    component: IngredientPage
  },
  {
    path: '/clients',
    name: 'clients',
    component: Client
  },
  {
    path: '/commandes',
    name: 'commandes',
    component: Commande
  },
  {
    path: '/recettes',
    name: 'recettes',
    component: RecettePage
  },
  {
    path: '/statistics',
    name: 'Statistics',
    component: Statistics,
  },
  {
    path: '/plats',
    name: 'plats',
    component: PlatPage
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
