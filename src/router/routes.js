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
    ]
  }
];
