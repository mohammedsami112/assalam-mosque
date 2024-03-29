<script setup>
import { onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'
import PageHeader from '@/components/global/pageHeader'
import PostsApi from '@/controllers/posts'

const router = useRouter()
const post = ref({})
const getPost = (postId) => {
  PostsApi.getPost(postId).then(response => {
    post.value = response.data
  })
}

onMounted(() => {
  getPost(router.currentRoute.value.params.id)
})

</script>

<template>
  <PageHeader :title="post.title" :background="post.thumbnail" />
  <v-container>
    <div class="post" v-html="post.content"></div>
  </v-container>
</template>

<style scoped>

</style>
