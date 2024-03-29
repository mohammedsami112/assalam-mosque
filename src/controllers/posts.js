import Api from '@/Api'

export default {

  getPost(postId) {
    return Api.get(`/posts/${postId}`).then(response => response.data)
  }

}
