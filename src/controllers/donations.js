import Api from '@/Api'
export default {

  getDonations(inputs) {
    return Api.get('/donations', {
      params: {
        page: inputs.page,
        limit: inputs.itemsPerPage
      }
    }).then(response => response.data)
  },

}
