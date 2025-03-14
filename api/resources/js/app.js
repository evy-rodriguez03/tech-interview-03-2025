import './bootstrap';

import { createApp } from 'vue';
import App from './App.vue';
import router from './router'; // Asegúrate de que esta importación es correcta

const app = createApp(App);

app.use(router); // Si usas Vue Router, asegúrate de agregarlo

app.mount('#app');
