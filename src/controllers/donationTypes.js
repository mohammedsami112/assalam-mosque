import Api from '@/Api'
export default {

  getTypes(inputs) {
    return Api.get('/donation-types', {
      params: {
        page: inputs.page,
        limit: inputs.itemsPerPage
      }
    }).then(response => response.data)
  },

  getType(typeId) {
    return Api.get(`/donation-types/${typeId}`).then(response => response.data)
  },

  manageDonationTypes(inputs) {
    let typeRoutes = inputs.item_id == null ? 'create' : 'update'

    let formData = new FormData()
    for(const key in inputs) {
      formData.append(key, inputs[key])
    }
    return Api({
      method: 'post',
      url: `/donation-types/${typeRoutes}`,
      data: formData,
      headers: { 'Content-Type': 'multipart/form-data' },
    }).then(response => response.data)

  },

  deleteTypes(inputs) {
    return Api.post('/donation-types/delete', inputs).then(response => response.data)
  }

}
