import {createApp} from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

import 'bootstrap/dist/css/bootstrap.min.css'
import '@fortawesome/fontawesome-free/css/all.css'

const app = createApp(App)

// app.config.devtools = true

app.config.globalProperties.$filters = {
  date(value, format = 'date') {
    const options = {}

    if (format.includes('date')) {
      options.day = '2-digit'
      options.month = 'long'
      options.year = 'numeric'
    }
    if (format.includes('time')) {
      options.hour = '2-digit'
      options.minute = '2-digit'
      options.second = '2-digit'
    }

    return new Intl.DateTimeFormat('ru-RU', options).format(new Date(value))
  },
  is_numeric(str) {
    return /^\d+$/.test(str)
  },
  getRandomInt(max) {
    return Math.floor(Math.random() * max)
  },
}

app.use(store).use(router).mount('#app')
