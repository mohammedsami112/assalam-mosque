<script setup>
  import AppHeader from "@/layouts/header.vue";
  import AppFooter from '@/layouts/footer.vue';
</script>
<template>
  <v-app>
    <AppHeader></AppHeader>
    <v-main>
      <router-view />
    </v-main>
    <AppFooter></AppFooter>
  </v-app>
</template>
