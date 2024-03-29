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
      },
      {
        path: '/posts',
        component: () => import('@/pages/posts/index.vue'),
        meta: {
          canAccess: 'posts'
        },
        children: [
          {
            path: '',
            name: 'view-posts',
            component: () => import('@/pages/posts/view.vue')
          },
          {
            path: 'create',
            name: 'create-posts',
            component: () => import('@/pages/posts/create.vue')

          },
          {
            path: 'update/:id?',
            name: 'update-posts',
            component: () => import('@/pages/posts/update.vue')

          }
        ],
      },
      {
        path: '/pages',
        component: () => import('@/pages/pages/index.vue'),
        meta: {
          canAccess: 'pages'
        },
        children: [
          {
            path: '',
            name: 'view-pages',
            component: () => import('@/pages/pages/view.vue')
          },
          {
            path: 'create',
            name: 'create-pages',
            component: () => import('@/pages/pages/create.vue')

          },
          {
            path: 'update/:id?',
            name: 'update-pages',
            component: () => import('@/pages/pages/update.vue')

          }
        ],
      },
      {
        path: '/gallery',
        component: () => import('@/pages/gallery/index.vue'),
        meta: {
          canAccess: 'gallery'
        },
        children: [
          {
            path: '',
            name: 'view-gallery',
            component: () => import('@/pages/gallery/view.vue')
          },
          {
            path: 'create',
            name: 'create-gallery',
            component: () => import('@/pages/gallery/create.vue')

          },
          {
            path: 'update/:id?',
            name: 'update-gallery',
            component: () => import('@/pages/gallery/update.vue')

          }
        ],
      },
      {
        path: '/donations',
        component: () => import('@/pages/donations/index.vue'),
        meta: {
          canAccess: 'donations'
        },
        children: [
          {
            path: '',
            name: 'view-donations',
            component: () => import('@/pages/donations/view.vue')
          },
        ],
      },
      {
        path: '/donation-types',
        component: () => import('@/pages/donation-types/index.vue'),
        meta: {
          canAccess: 'donations'
        },
        children: [
          {
            path: '',
            name: 'view-donation-types',
            component: () => import('@/pages/donation-types/view.vue')
          },
          {
            path: 'create',
            name: 'create-donation-types',
            component: () => import('@/pages/donation-types/create.vue')

          },
          {
            path: 'update/:id?',
            name: 'update-donation-types',
            component: () => import('@/pages/donation-types/update.vue')

          }
        ],
      },
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
