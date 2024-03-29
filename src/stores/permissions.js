
export const usePermissionsStore = defineStore('Permissions', {

  state: () => ({
    roles: [ 'permissions', 'users', 'posts', 'pages', 'categories', 'comments', 'donations', 'gallery',  ],
  }),

})
