<script setup>
  import { defineProps } from 'vue'

  const props = defineProps(['socials'])

</script>

<template>

  <div class="social">
    <ul class="flex">
      <li>
        <router-link class="text-primary" :to="{ name: 'prayer-page' }">
          <font-awesome-icon :icon="['fas', 'mosque']" />
        </router-link>
      </li>
      <li v-if="props.socials.google_map != null">
        <a class="text-primary" :href="props.socials.google_map"><FontAwesomeIcon :icon="['fa', 'location-dot']"></FontAwesomeIcon></a>
      </li>
      <li v-if="props.socials.phone != null">
        <a class="text-primary" :href="'https://api.whatsapp.com/send/?phone=' + props.socials.phone"><FontAwesomeIcon :icon="['fab', 'whatsapp']"></FontAwesomeIcon></a>
      </li>
      <li v-if="props.socials.facebook != null">
        <a class="text-primary" :href="props.socials.facebook"><FontAwesomeIcon :icon="['fab', 'facebook']"></FontAwesomeIcon></a>
      </li>
      <li v-if="props.socials.youtube != null">
        <a class="text-primary" :href="props.socials.youtube"><FontAwesomeIcon :icon="['fab', 'youtube']"></FontAwesomeIcon></a>
      </li>
      <li v-if="props.socials.instagram != null">
        <a class="text-primary hover:bg-primary" :href="props.socials.instagram"><FontAwesomeIcon :icon="['fab', 'instagram']"></FontAwesomeIcon></a>
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
