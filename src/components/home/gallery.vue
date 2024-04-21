<script setup>
  import { useAppStore } from "@/store/app";
  import { Swiper, SwiperSlide } from "swiper/vue";
  import 'swiper/css'
  import moment from "moment/moment";
  const AppStore = useAppStore()
</script>

<template>
  <section class="section gallery-section">
    <v-container>

      <swiper
        :slides-per-view="1"
        :space-between="10"
        :breakpoints="{
          '640': {
            slidesPerView: 1,
            spaceBetween: 20,
          },
          '768': {
            slidesPerView: 2,
            spaceBetween: 40,
          },
          '1024': {
            slidesPerView: 3,
            spaceBetween: 50,
          },
        }"
      >
        <swiper-slide v-for="item in AppStore.home.gallery">
          <div class="gallery-card relative block mb-[30px]">
            <div class="gallery-image relative block overflow-hidden rounded-[20px] z-[1]">
              <img class="w-full h-full" :src="item.image" alt="">
              <div class="content absolute left-0 right-0 bottom-[44px] text-center translate-y-[-100px] opacity-0 transition-all duration-700 ease-in-out">
                <p class="text-[24px] text-primary-dark font-[700] leading-[24px] pb-[8px]">Charity</p>
                <h5 class="text-[34px] font-[900] leading-[34px] text-primary-dark">Education</h5>
              </div>
            </div>
          </div>
        </swiper-slide>
      </swiper>
    </v-container>
  </section>
</template>

<style scoped>

</style>
