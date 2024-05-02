<script setup>
  import { ref } from "vue";
  import { Swiper, SwiperSlide } from 'swiper/vue';
  import { Autoplay } from 'swiper/modules'
  import 'swiper/css';

  import SliderImage1 from '@/assets/images/slider/1.jpeg'
  import SliderImage2 from '@/assets/images/slider/2.jpeg'
  import SliderImage3 from '@/assets/images/slider/3.jpeg'

  const sliderData = ref([
    {
      image: SliderImage1,
      subTitle: 'Vermittlung der Wissenschaften des Korans',
      title: 'Die Besten unter euch sind diejenigen, die den Koran lernen und ihn anderen lehren',
      route: {
        path: '/',
        hash: "#features"
      }
    },
    {
      image: SliderImage2,
      subTitle: 'Unterrichten des Heiligen Korans und der arabischen Sprache',
      title: 'Melden Sie Ihre Kinder bei uns an',
      route: {
        path: '/',
        hash: "#features"
      }
    },
    {
      image: SliderImage3,
      subTitle: 'Frühstück für den Fastenden',
      title: 'من فطَّر صائماً كان له مثل أجره غير أنه لا ينقص من أجر الصائم شيئاً\n' +
        'صدق رسول الله',
      route: {
        path: '/',
        hash: "#donations"
      }
    },

  ])

</script>

<template>
  <div class="main-slider">
    <swiper
      :slides-per-view="1"
      :loop="true"
      :autoplay="{
        delay: 5000,
        disableOnInteraction: true,
      }"
      :modules="[Autoplay]"
    >
      <swiper-slide v-for="(item, index) in sliderData" :key="index">
        <div class="slider-item">
          <div class="slider-background" :style="{background: 'url('+item.image+')'}"></div>
          <v-container class="h-full">
            <div class="slider-content">
              <p>{{ item.subTitle }}</p>
              <h2>{{ item.title }}</h2>
              <router-link :to="item.route">
                <v-btn variant="tonal" flat color="primary2">
                  Finde mehr heraus
                </v-btn>
              </router-link>
            </div>
          </v-container>
        </div>
      </swiper-slide>
    </swiper>
  </div>
</template>

<style scoped>

</style>
