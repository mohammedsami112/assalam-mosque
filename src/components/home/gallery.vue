<script setup>
  import { useAppStore } from "@/store/app";

  const AppStore = useAppStore()
</script>

<template>
  <section class="section gallery-section">
    <v-container>
      <v-row>
        <v-col cols="12" lg="4" md="6" v-for="item in AppStore.home.gallery">
          <div class="gallery-card relative block mb-[30px]">
            <div class="gallery-image relative block overflow-hidden rounded-[20px] z-[1]">
              <img class="w-full" :src="item.image" alt="">
              <div class="content absolute left-0 right-0 bottom-[44px] text-center translate-y-[-100px] opacity-0 transition-all duration-700 ease-in-out">
                <p class="text-[24px] text-primary-dark font-[700] leading-[24px] pb-[8px]">Charity</p>
                <h5 class="text-[34px] font-[900] leading-[34px] text-primary-dark">Education</h5>
              </div>
            </div>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </section>
</template>

<style scoped>

</style>
