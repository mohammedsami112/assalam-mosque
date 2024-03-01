import Api from '@/Api'

export default {

  getDashboard() {
    return Api.get('/home').then(response => response.data)
  },

  getPermissionsList() {
    return Api.get('/permissions-list').then(response => response.data);
  },

  getCategoriesList(parent = null) {
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
