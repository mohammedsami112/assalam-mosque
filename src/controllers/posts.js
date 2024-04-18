import Api from '@/Api'

export default {

  getPost(postId) {
    return Api.get(`/posts/${postId}`).then(response => response.data)
  },

  getPosts(categoryId = 1) {
    return Api.get('/posts/', {params: {categoryId:categoryId}}).then(response => response.data)
  }

}
