import Api from '@/Api'

export default {

  login(inputs) {
    return Api.post('/auth/login', inputs).then(response => response.data);
  },

  logout() {
    return Api.post('/auth/logout').then(response => response.data)
  }

}
