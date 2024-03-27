<script setup>
  import { defineProps } from 'vue'

  const props = defineProps(['title'])
</script>

<template>
  <div class="page-header">
    <div class="content">
      <h1>{{ props.title }}</h1>
    </div>
  </div>
</template>

<style scoped>

</style>
