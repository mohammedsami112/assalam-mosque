<script setup>
  import { useRouter } from 'vue-router'

  const router = useRouter()
</script>
<template>
  <h1>Update USers : {{ router.currentRoute.value.params.id }}</h1>
</template>
