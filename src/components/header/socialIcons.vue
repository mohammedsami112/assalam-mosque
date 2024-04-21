<script setup>
  import { defineProps } from 'vue'
  import {useAppStore} from "@/store/app";

  const AppStore = useAppStore()

</script>

<template>

  <div class="social">
    <ul class="flex flex-wrap justify-center">
      <li class="mb-[4px] xl:mb-0 xl:hidden">
        <router-link class="text-primary" :to="{ name: 'donation-page' }">
          <span class="mdi mdi-heart  text-[24px]"></span>
        </router-link>
      </li>
      <li class="mb-[4px] xl:mb-0">
        <router-link class="text-primary" :to="{ name: 'prayer-page' }">
          <font-awesome-icon :icon="['fas', 'mosque']" />
        </router-link>
      </li>
      <li class="mb-[4px] xl:mb-0" v-if="AppStore.socials.google_map != null">
        <a class="text-primary" :href="AppStore.socials.google_map"><FontAwesomeIcon :icon="['fa', 'location-dot']"></FontAwesomeIcon></a>
      </li>
      <li class="mb-[4px] xl:mb-0" v-if="AppStore.socials.phone != null">
        <a class="text-primary" :href="'https://api.whatsapp.com/send/?phone=' + AppStore.socials.phone"><FontAwesomeIcon :icon="['fab', 'whatsapp']"></FontAwesomeIcon></a>
      </li>
      <li class="mb-[4px] xl:mb-0" v-if="AppStore.socials.facebook != null">
        <a class="text-primary" :href="AppStore.socials.facebook"><FontAwesomeIcon :icon="['fab', 'facebook']"></FontAwesomeIcon></a>
      </li>
      <li class="mb-[4px] xl:mb-0" v-if="AppStore.socials.youtube != null">
        <a class="text-primary" :href="AppStore.socials.youtube"><FontAwesomeIcon :icon="['fab', 'youtube']"></FontAwesomeIcon></a>
      </li>
      <li class="mb-[4px] xl:mb-0" v-if="AppStore.socials.instagram != null">
        <a class="text-primary hover:bg-primary" :href="AppStore.socials.instagram"><FontAwesomeIcon :icon="['fab', 'instagram']"></FontAwesomeIcon></a>
      </li>
      <li class="mb-[4px] xl:mb-0" v-if="AppStore.socials.tiktok != null">
        <a class="text-primary hover:bg-primary" :href="AppStore.socials.tiktok"><FontAwesomeIcon :icon="['fab', 'tiktok']"></FontAwesomeIcon></a>
      </li>
    </ul>
  </div>

</template>

<style lang="scss" scoped>
  @import '@/assets/scss/_vars.scss';
  .social {
    ul {
      li {
        a {
          @apply mr-2 w-[40px] h-[40px] flex justify-center items-center rounded-full border-[1px] transition-all duration-500 ease-in-out;
          &:hover {
            @apply text-white #{!important};
            background: $primary!important;
          }
        }
      }
    }
  }

</style>
