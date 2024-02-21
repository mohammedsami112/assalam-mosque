import { createApp } from 'vue'
import App from '@/App.vue'
import { registerPlugins } from '@core/utils/plugins'

// Toast
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

// Sweet Alert
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

// Styles
import '@core/scss/template/index.scss'
import '@layouts/styles/index.scss'

// Create vue app
const app = createApp(App)


// Register plugins
registerPlugins(app)

app.use(Toast, {
  position: "top-right",
  timeout: 3000,
  closeOnClick: true,
  pauseOnFocusLoss: true,
  pauseOnHover: true,
  draggable: true,
  draggablePercent: 0.6,
  showCloseButtonOnHover: false,
  hideProgressBar: true,
  closeButton: "button",
  icon: true,
  rtl: false
})

app.use(VueSweetalert2);

// Mount vue app
app.mount('#app')
