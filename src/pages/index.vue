<script setup>
  import AppHeader from "@/layouts/header.vue";
  import AppFooter from '@/layouts/footer.vue';
  import WhatsAppButton from "@/components/global/whatsAppButton";
</script>
<template>
  <v-app>
    <AppHeader></AppHeader>
    <v-main>
      <router-view />
    </v-main>
    <AppFooter></AppFooter>
    <WhatsAppButton />
  </v-app>
</template>
