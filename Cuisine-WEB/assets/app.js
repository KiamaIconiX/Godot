import { createApp } from 'vue';
import App from './App.vue';
import router from '../router'; // Importer le router

createApp(App)
  .use(router)  // Ajouter le router à l'application
  .mount('#app');
