import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import vuetify from './plugins/vuetify'
import axios from 'axios'
import { createPinia } from 'pinia'

axios.defaults.withCredentials = true
axios.defaults.baseURL = 'https://test1.webastera.com'
const app = createApp(App)

app.config.globalProperties.$axios = axios

app.use(router)
   .use(vuetify)
   .use(createPinia())
   .mount('#app')
