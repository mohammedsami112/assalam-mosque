// Utilities
import { defineStore } from 'pinia'

export const usePostsStore = defineStore('posts-store', {
  state: () => ({
    posts: [],
  }),

  actions: {
    setPosts(data) {
      this.posts = data
    },

  }
})
