<script setup>
  import { onMounted, ref } from 'vue'
  import GlobalApi from '@/controllers/global'
  import PostsApi from '@/controllers/posts'
  import { useAppStore } from '@/store/app'
  import { usePostsStore } from "@/store/posts";

  const AppStore = useAppStore()
  const PostsStore = usePostsStore()

  onMounted(() => {
      GlobalApi.getHome().then(response => {
        AppStore.setHomeData(response.data)
      }).finally(() => {
        AppStore.homeLoading = false
      })

      PostsApi.getPosts().then(response => {
        PostsStore.setPosts(response.data)
      })
  })
</script>

<template>
  <router-view></router-view>
</template>

