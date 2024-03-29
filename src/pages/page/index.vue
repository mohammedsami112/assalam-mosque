<script setup>
  import { onMounted, ref } from 'vue'
  import { useRouter } from 'vue-router'
  import PageHeader from '@/components/global/pageHeader'
  import PagesApi from '@/controllers/pages'

  const router = useRouter()
  const page = ref({})
  const getPage = (pageId) => {
    PagesApi.getPage(pageId).then(response => {
      page.value = response.data
    })
  }

  onMounted(() => {
    getPage(router.currentRoute.value.params.id)
  })

</script>

<template>
  <PageHeader :title="page.title" />
  <v-container>
    <div class="page-content" v-html="page.content"></div>
  </v-container>
</template>

<style scoped>

</style>
