import { createRouter, createWebHistory } from 'vue-router'
import { routes } from './routes'

const router = createRouter({
  history: createWebHistory('/'),
  routes,
})

router.beforeEach((to, from, next) => {

  console.log(to);
  console.log(from);

  const isLoggedIn = localStorage.getItem('token')
  if (to.name !== 'login' && !isLoggedIn) {
    next({name: 'login'})
  }

  if (to.name == 'login' && isLoggedIn) {
    next({name: 'dashboard'})
  }

  return next();

});

export default function (app) {
  app.use(router)
}
export { router }