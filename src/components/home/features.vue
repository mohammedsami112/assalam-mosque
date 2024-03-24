<script setup>
  import { ref } from 'vue'
  import Image1 from '@/assets/images/features/1.jpg'
  import Image2 from '@/assets/images/features/2.jpg'
  import Image3 from '@/assets/images/features/3.jpg'

  const data = ref([
    {
      image: Image1,
      title: 'الروضة'
    },
    {
      image: Image2,
      title: 'المستوى الاول'
    },
    {
      image: Image3,
      title: 'المستوى الثاني'
    },
  ])
</script>

<template>
  <section class="section features-section relative block">
    <v-container>
      <v-row>
        <v-col class="flex justify-center xl:block" cols="12" lg="4" v-for="(item, index) in data" :key="index">
          <div class="feature-card relative block w-[320px] xl:w-auto min-h-[447px] z-[2]">
            <div class="background absolute top-0 left-[-29px] right-[-28px] bottom-0 bg-cover z-[2] " :style="{background: 'url('+item.image+') no-repeat center center'}"></div>
            <div class="title-box absolute bottom-[110px] left-[90px] z-[2] rotate-[-16deg]">
              <h3 class="text-[35px] font-[900] leading-[60px] text-transparent" style="-webkit-text-stroke: 2px #fff">{{ item.title }}</h3>
            </div>
            <div class="btn-box absolute bottom-[42px] left-[135px] z-[2] rotate-[-13deg]">
              <a href="#" class="relative text-[18px] text-white leading-[18px] font-[500] bottom-0 left-0 bg-primary pt-[3px] pr-[40px] pb-[3px] pl-[40px] rounded-tl-[5px] rounded-bl-[25px] rounded-br-[25px] transition-all duration-500 ease-in-out">سجل لدينا</a>
            </div>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </section>
</template>

<style scoped>

</style>
