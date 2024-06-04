import Api from '@/Api'
export default {

  getPages(inputs) {
    return Api.get('/pages', {
      params: {
        page: inputs.page,
        limit: inputs.itemsPerPage
      }
    }).then(response => response.data)
  },

  getPage(pageId) {
    return Api.get(`/pages/${pageId}`).then(response => response.data)
  },

  managePages(inputs) {
    let pagesRoute = inputs.item_id == null ? 'create' : 'update'
    let formData = new FormData()
    for(const key in inputs) {
      formData.append(key, inputs[key])
    }
    return Api({
      method: 'post',
      url: `/pages/${pagesRoute}`,
      data: formData,
      headers: { 'Content-Type': 'multipart/form-data' },
    }).then(response => response.data)

  },

  deletePages(inputs) {
    return Api.post('/pages/delete', inputs).then(response => response.data)
  }

}
