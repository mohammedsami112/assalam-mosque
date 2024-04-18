/**
 * plugins/index.js
 *
 * Automatically included in `./src/main.js`
 */

// Plugins
import vuetify from './vuetify'
import pinia from '@/store'
import router from '@/router'
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { library } from "@fortawesome/fontawesome-svg-core";
import { faLocationDot, faMosque } from "@fortawesome/free-solid-svg-icons";
import { faFacebook, faYoutube, faInstagram, faWhatsapp } from "@fortawesome/free-brands-svg-icons";


export function registerPlugins (app) {
  app
    .use(vuetify)
    .use(router)
    .use(pinia)
    .use(Toast)

  library.add(faLocationDot, faFacebook, faYoutube, faInstagram, faWhatsapp, faMosque)

  app.component("FontAwesomeIcon", FontAwesomeIcon)
}
