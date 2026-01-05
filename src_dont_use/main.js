import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import { createPinia } from 'pinia'
import { createVuetify } from 'vuetify'
import { nl, en } from 'vuetify/locale'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import 'vuetify/styles'
import { aliases, fa } from 'vuetify/iconsets/fa-svg'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { far } from '@fortawesome/free-regular-svg-icons'
import VueBarcode from '@chenfengyuan/vue-barcode';
import { custom} from './icons/CustomSet'
// import '@/styles/customsettings.scss'
import '../public/lib/css/argon-dashboard.css'
const app = createApp(App)

const pinia = createPinia()
app.component(VueBarcode.name, VueBarcode);

app.component('font-awesome-icon', FontAwesomeIcon)
library.add(fas)
library.add(far)

const myCustomLightTheme = {
  dark: false,
  colors: {
    primary: '#39b145',
    error: '#f00',
  },
}

const vuetify = createVuetify({
    components,
    directives,
    icons: {
      defaultSet: 'fa',
      aliases,
      sets: {
        fa,
        custom: custom
      },
    },
    locale: {
      locale: 'nl',
      fallback: 'en',
      messages: { nl, en }
    },
    theme: {
      defaultTheme: 'myCustomLightTheme',
      themes: {
        myCustomLightTheme,
      },
    },
  })

app
  .use(router)
  .use(pinia)
  .use(router)
  .use(vuetify).mount('#app')