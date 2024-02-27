import Api from '@/Api'
export default {

  getPosts(inputs) {
    return Api.get('/posts', {
      params: {
        page: inputs.page,
        limit: inputs.itemsPerPage
      }
    }).then(response => response.data)
  },

  getPost(postId) {
    return Api.get(`/posts/${postId}`).then(response => response.data)
  },

  managePosts(inputs) {
    let postsRoute = inputs.item_id == null ? 'create' : 'update'
    let formData = new FormData()
    for(const key in inputs) {
      formData.append(key, inputs[key])
    }
    return Api({
      method: 'post',
      url: `/posts/${postsRoute}`,
      data: formData,
      headers: { 'Content-Type': 'multipart/form-data' },
    }).then(response => response.data)

  },

  deletePosts(inputs) {
    return Api.post('/posts/delete', inputs).then(response => response.data)
  }

}
