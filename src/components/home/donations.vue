<script setup>
  import {useAppStore} from "@/store/app";
  import { Swiper, SwiperSlide } from "swiper/vue";
  import 'swiper/css'
  import DonationButton from '@/components/home/donationButton'

  const AppStore = useAppStore()
</script>

<template>
  <section class="section donations-section relative !pt-[270px] !pb-[90]" id="donations">
    <div class="background absolute top-0 left-0 right-0 h-[645px] bg-primary-dark z-[0]"></div>
    <v-container class="relative z-[1]">
      <div class="title text-center">
        <span class="text-primary2 block text-[15px] xl:text-[24px] font-[700] leading-[24px] mb-[20px]">ســـاعد وتبـــــــرع</span>
        <h2 class="text-white block text-[26px] xl:text-[50px] leading-[60px] font-[900] mt-[6px] mb-[40px]">
          قال النبي صلى الله عليه وسلم
          <br>
          مَنْ بَنَى مَسْجِدًا بَنَى اللَّهُ لَهُ مِثْلَهُ فِي الْجَنَّةِ
        </h2>
      </div>
      <DonationButton></DonationButton>


      <swiper
        :slides-per-view="1"
        :space-between="10"
        :breakpoints="{
          '640': {
            slidesPerView: 2,
            spaceBetween: 20,
          },
          '768': {
            slidesPerView: 4,
            spaceBetween: 40,
          },
          '1024': {
            slidesPerView: 4,
            spaceBetween: 50,
          },
        }"
      >
<!--        <swiper-slide v-for="item in AppStore.home.donation_types" :key="item.id">-->
<!--          <router-link :to="{name: 'donation-page', params: {type: item.id}}">-->
<!--            <div class="donation-card relative block">-->
<!--              <div class="card-thumbnail relative block rounded-tl-[20px] rounded-tr-[20px] overflow-hidden z-[1]">-->
<!--                <img class="w-full" width="370" height="250" :src="item.thumbnail" alt="">-->
<!--              </div>-->
<!--              <div class="card-content relative block bg-white rounded-bl-[20px] rounded-br-[20px] border-[1px] border-solid border-[#eee9db] pt-[22px] pr-[30px] pb-[30px] pl-[20px] border-t-0">-->
<!--                <h3 class="title text-[26px] leading-[36px] font-[800] text-primary-dark">-->
<!--                  {{ item.title }}-->
<!--                </h3>-->
<!--              </div>-->
<!--            </div>-->
<!--          </router-link>-->
<!--        </swiper-slide>-->
      </swiper>

    </v-container>
  </section>
</template>

<style scoped>

</style>
