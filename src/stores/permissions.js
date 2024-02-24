
export const usePermissionsStore = defineStore('Permissions', {

  state: () => ({
    roles: [ 'permissions', 'users', 'posts', 'categories', 'comments', 'donations', 'gallery' ],
  }),

})
