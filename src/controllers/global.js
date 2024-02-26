import Api from '@/Api'

export default {

  getPermissionsList() {
    return Api.get('/permissions-list').then(response => response.data);
  },

  getCategoriesList() {
    return Api.get('/categories-list').then(response => response.data);
  },

  getAbilities() {
    return Api.get('/abilities').then(response => response.data)
  }

}
