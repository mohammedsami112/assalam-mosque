/**
 * router/index.ts
 *
 * Automatic routes for `./src/pages/*.vue`
 */

// Composables
import { createRouter, createWebHistory } from 'vue-router'
import { routes } from '@/router/routes'

const router = createRouter({
  history: createWebHistory('/'),
  routes,
})

export default router
