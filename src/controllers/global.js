import Api from '@/Api'

export default {

  getPermissionsList() {
    return Api.get('/permissions-list').then(response => response.data);
  },

  getCategoriesList(parent = false) {
    return Api.get('/categories-list', {
      params: {
        parent: parent
      }
    }).then(response => response.data);
  },

  getAbilities() {
    return Api.get('/abilities').then(response => response.data)
  }

}
