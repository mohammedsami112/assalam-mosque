import { createRouter, createWebHistory } from 'vue-router'
import { routes } from './routes'
import { useUserStore } from '@/stores/user'
const router = createRouter({
  history: createWebHistory('/'),
  routes,
})

router.beforeEach(async (to, from, next) => {

  console.log(to)
  const isLoggedIn = localStorage.getItem('token')
  if (to.name !== 'login' && !isLoggedIn) {
    next({name: 'login'})
  }

  if (to.name == 'login' && isLoggedIn) {
    next({name: 'dashboard'})
  }

  if (isLoggedIn) {
    const userStore = useUserStore()
    await userStore.getAbilities()

    let accessPermission = to.matched[1].meta.canAccess == null ? true : userStore.permissions == '*' ? true : userStore.permissions.filter(permission => permission == to.matched[1].meta.canAccess).length > 0;
    if (!accessPermission) {
      next({name: 'dashboard'})
    }
  }

  return next();

});

export default function (app) {
  app.use(router)
}
export { router }
