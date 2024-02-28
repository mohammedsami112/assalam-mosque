import Api from '@/Api'
export default {

  getImages(inputs) {
    return Api.get('/gallery', {
      params: {
        page: inputs.page,
        limit: inputs.itemsPerPage
      }
    }).then(response => response.data)
  },

  manageImages(inputs) {
    let galleryRoute = inputs.item_id == null ? 'create' : 'update'

    let formData = new FormData()
    for(const key in inputs) {
      formData.append(key, inputs[key])
    }
    return Api({
      method: 'post',
      url: `/gallery/${galleryRoute}`,
      data: formData,
      headers: { 'Content-Type': 'multipart/form-data' },
    }).then(response => response.data)

  },

  deleteImages(inputs) {
    return Api.post('/gallery/delete', inputs).then(response => response.data)
  }

}
