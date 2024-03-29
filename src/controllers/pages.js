import Api from '@/Api'

export default {

  getPage(pageId) {
    return Api.get(`/pages/${pageId}`).then(response => response.data)
  }

}
