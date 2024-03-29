/**
 * main.js
 *
 * Bootstraps Vuetify and other plugins then mounts the App`
 */


// Plugins
import { registerPlugins } from '@/plugins'
import "@/assets/scss/main.scss"

import mitt from 'mitt'
const emitter = mitt()

// Components
import App from './App.vue'

// Composables
import { createApp } from 'vue'

const app = createApp(App)


registerPlugins(app)
app.provide('emitter', emitter)

app.mount('#app')
