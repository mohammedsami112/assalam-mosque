<script setup>
  import { onMounted } from 'vue'
  import GlobalApi from '@/controllers/global'
  import { useAppStore } from '@/store/app'

  const AppStore = useAppStore()

  onMounted(() => {
      GlobalApi.getHome().then(response => {
        AppStore.setHomeData(response.data)
      }).finally(() => {
        AppStore.homeLoading = false
      })
  })
</script>

<template>
  <router-view></router-view>
</template>

