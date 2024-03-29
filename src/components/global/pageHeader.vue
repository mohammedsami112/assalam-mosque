<script setup>
  import { defineProps } from 'vue'

  const props = defineProps(['title', 'background'])
</script>

<template>
  <div class="page-header" :style="{ background: props.background ? 'url('+props.background+') no-repeat center center fixed' : false, 'background-size': props.background ? 'cover' : false }">
    <div class="content">
      <h1>{{ props.title }}</h1>
    </div>
  </div>
</template>

<style scoped>

</style>
