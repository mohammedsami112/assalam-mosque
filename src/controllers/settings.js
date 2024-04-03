import Api from '@/Api'

export default {

  getSettings() {
    return Api.get('/settings').then(response => response.data)
  },

  updateSettings(inputs) {
    return Api.post('/settings/update', inputs).then(response => response.data)
  }

}
