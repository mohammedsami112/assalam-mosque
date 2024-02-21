import Api from '@/Api'

export default {

  getPermissionsList() {
    return Api.get('/permissions-list').then(response => response.data);
  }

}
