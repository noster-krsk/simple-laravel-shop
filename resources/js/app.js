import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import vuetify from './plugins/vuetify'
import axios from 'axios'

axios.defaults.withCredentials = true
axios.defaults.baseURL = 'http://localhost'
const app = createApp(App)

app.config.globalProperties.$axios = axios

app.use(router)
   .use(vuetify)
   .mount('#app')
