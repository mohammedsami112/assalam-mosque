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

import { useUserStore } from '@/stores/user'
import CKEditor from '@ckeditor/ckeditor5-vue';

// Create vue app
const app = createApp(App)

app.config.globalProperties.$canAccess = (permission) => {
  const userStore = useUserStore()
  return permission == null ? true : userStore.permissions == '*' ? true : userStore.permissions.filter(accessPermission => accessPermission == permission).length > 0
}
app.provide('$canAccess', app.config.globalProperties.$canAccess);

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
app.use(CKEditor)

// Mount vue app
app.mount('#app')