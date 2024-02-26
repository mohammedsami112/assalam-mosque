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
        component: () => import('@/pages/users/index.vue'),
        meta: {
          canAccess: 'users'
        },
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
      },
      {
        path: '/permissions',
        component: () => import('@/pages/permissions/index.vue'),
        meta: {
          canAccess: 'permissions'
        },
        children: [
          {
            path: '',
            name: 'view-permissions',
            component: () => import('@/pages/permissions/view.vue')
          },
          {
            path: 'create',
            name: 'create-permissions',
            component: () => import('@/pages/permissions/create.vue')

          },
          {
            path: 'update/:id?',
            name: 'update-permissions',
            component: () => import('@/pages/permissions/update.vue')

          }
        ],
      },
      {
        path: '/categories',
        component: () => import('@/pages/permissions/index.vue'),
        meta: {
          canAccess: 'categories'
        },
        children: [
          {
            path: '',
            name: 'view-categories',
            component: () => import('@/pages/categories/view.vue')
          },
          {
            path: 'create',
            name: 'create-categories',
            component: () => import('@/pages/categories/create.vue')

          },
          {
            path: 'update/:id?',
            name: 'update-categories',
            component: () => import('@/pages/categories/update.vue')

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
