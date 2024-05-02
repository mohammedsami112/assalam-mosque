<script setup>
  import { defineProps } from 'vue'
  import SocialIcons from "@/components/header/socialIcons.vue";

  const props = defineProps(['mainSettings'])
</script>

<template>
  <div class="top hidden xl:flex items-center justify-between pt-[18px] pb-[18px]">
    <div class="left block">
      <router-link :to="{name: 'donation-page'}">
        <div class="volunteers flex items-center">
        <div class="icon relative w-[44px] h-[44px] bg-primary2 rounded-[50%] flex items-center justify-center">
          <span class="mdi mdi-heart text-primary text-[24px]"></span>
        </div>
        <div class="text-box ml-[10px]">
          <p class="text-primary-dark  font-[700] text-[24px]">
            <span>Seien Sie ein </span>
            Mitwirkender
          </p>
        </div>
      </div>
      </router-link>
    </div>
    <div class="right flex items-center">
      <social-icons :socials="props.mainSettings"></social-icons>
    </div>
  </div>
</template>

<style scoped>

</style>
