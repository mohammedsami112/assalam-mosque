export const routes = [
  {
    path: '/',
    component: () => import('@/pages/index.vue'),
    children: [
      {
        path: '/home',
        name: 'home-page',
        component: () => import('@/pages/home/index.vue')
      }
    ]
  }
];
