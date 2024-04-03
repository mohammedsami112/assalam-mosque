export const routes = [
  {
    path: '/',
    component: () => import('@/pages/index.vue'),
    children: [
      {
        path: '/home',
        alias: '/',
        name: 'home-page',
        component: () => import('@/pages/home/index.vue')
      },
      {
        path: '/donation/:type?',
        name: 'donation-page',
        component: () => import('@/pages/donations/index.vue')
      },
      {
        path: '/page/:id/:slug',
        name: 'pages-page',
        component: () => import('@/pages/page/index.vue')
      },
      {
        path: '/post/:id/:slug',
        name: 'posts-page',
        component: () => import('@/pages/posts/index.vue')
      },
      {
        path: '/prayer-time',
        name: 'prayer-page',
        component: () => import('@/pages/prayer-time/index.vue')
      },
    ]
  }
];
