// plugins/vuetify.js
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import { aliases, mdi } from 'vuetify/iconsets/mdi'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import '@mdi/font/css/materialdesignicons.css'
import { VDataTable } from 'vuetify/labs/VDataTable' // ✅ ← ЭТО ДОБАВЬ

export default createVuetify({
   components: {
    ...components,
    VDataTable, // ✅ ← ЭТО ДОБАВЬ
  },
  directives, // 🔥 обязательно!
  icons: {
    defaultSet: 'mdi',
    aliases,
    sets: {
      mdi,
    },
  },
})
