<script setup>
  import AppHeader from "@/layouts/header.vue";
</script>
<template>
  <v-app>
    <AppHeader></AppHeader>
    <v-main>
      <router-view />
    </v-main>
  </v-app>
</template>
