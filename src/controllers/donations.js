import Api from '@/Api'

export default {

  getLatestDonations() {
    return Api.get('/donations').then(response => response.data)
  },

  getDonationTypes() {
    return Api.get('/donations/types').then(response => response.data)
  },

  makeDonation(payload) {
    return Api.post('/donations/create', payload).then(response => response.data)
  }

}
