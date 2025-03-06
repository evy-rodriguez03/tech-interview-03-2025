import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import { createVuetify } from "vuetify";
import router from './router'

const app = createApp(App)

app.use(router).use(createVuetify()).mount('#app')
