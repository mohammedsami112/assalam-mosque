export const routes = [
  { path: '/', redirect: '/dashboard' },
  {
    path: '/',
    component: () => import('@/layouts/default.vue'),
    children: [
      {
        path: 'dashboard',
        name: 'dashboard',
        component: () => import('@/pages/dashboard/index.vue'),
      },
      {
        path: '/users',
        // name: 'users',
        component: () => import('@/pages/users/index.vue'),
        children: [
          {
            path: '',
            name: 'view-users',
            component: () => import('@/pages/users/view.vue')
          },
          {
            path: 'create',
            name: 'create-users',
            component: () => import('@/pages/users/create.vue')

          },
          {
            path: 'update/:id?',
            name: 'update-users',
            component: () => import('@/pages/users/update.vue')

          }
        ],
      }

    ],
  },
  {
    path: '/',
    component: () => import('@/layouts/blank.vue'),
    children: [
      {
        path: 'login',
        name: 'login',
        component: () => import('@/pages/login.vue'),
      },
    ],
  },
]
