<script setup>
import UpgradeToPro from '@/components/UpgradeToPro.vue'
import { useUserStore } from '@/stores/user'

const userStore = useUserStore()

onMounted(() => {
  if (localStorage.getItem('token')) {

    userStore.accessToken = localStorage.getItem('token')
    userStore.userData = JSON.parse(localStorage.getItem('userData'))

  }
})

</script>

<template>
  <VApp>
    <RouterView />
<!--    <UpgradeToPro />-->
  </VApp>
</template>
