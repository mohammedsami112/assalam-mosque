import { createRouter, createWebHistory } from 'vue-router'
import { routes } from './routes'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
})

router.beforeEach((to, from, next) => {

  console.log(to);
  console.log(from);
  next();

});

export default function (app) {
  app.use(router)
}
export { router }
