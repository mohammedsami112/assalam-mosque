import Api from '@/Api'
export default {

  getCategories(inputs) {
    return Api.get('/categories', {
      params: {
        page: inputs.page,
        limit: inputs.itemsPerPage
      }
    }).then(response => response.data)
  },

  getCategory(categoryId) {
    return Api.get(`/categories/${categoryId}`).then(response => response.data)
  },

  manageCategories(inputs) {
    let categoriesRoute = inputs.item_id == null ? 'create' : 'update'

    return Api.post(`/categories/${categoriesRoute}`, inputs).then(response => response.data);

  },

  deleteCategories(inputs) {
    return Api.post('/categories/delete', inputs).then(response => response.data)
  }

}
