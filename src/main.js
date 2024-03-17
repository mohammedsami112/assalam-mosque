/**
 * main.js
 *
 * Bootstraps Vuetify and other plugins then mounts the App`
 */

import "@/assets/scss/main.scss"

// Plugins
import { registerPlugins } from '@/plugins'

// Components
import App from './App.vue'

// Composables
import { createApp } from 'vue'
import {useAppStore} from "@/store/app";

const app = createApp(App)


registerPlugins(app)

app.mount('#app')
