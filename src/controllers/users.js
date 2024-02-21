import Api from '@/Api'

export default {

  getUsers(inputs) {
    return Api.get('/users', {
      params: {
        page: inputs.page,
        limit: inputs.itemsPerPage
      }
    }).then(response => response.data)
  },

  getUser(userId) {
    return Api.get(`/users/${userId}`).then(response => response.data)
  },

  manageUsers(inputs) {
    let usersRoute = inputs.item_id == null ? 'create' : 'update'

    return Api.post(`/users/${usersRoute}`, inputs).then(response => response.data);

  },

  deleteUsers(inputs) {
    return Api.post('/users/delete', inputs).then(response => response.data)
  }

}
