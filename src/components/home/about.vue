<script setup>
  import Image1 from '@/assets/images/about/1.jpg'
  import Image2 from '@/assets/images/about/2.jpg'
</script>

<template>
  <section class="section about-section mb-20" id="about">
    <v-container>
      <v-row>
        <v-col cols="12" lg="6">
          <div class="left text-center xl:!text-left">
            <div class="title mb-[28px] ">
              <span class="text-[21px] font-[700] text-primary mb-[10px] leading-[24px] block">سجلوا أبنائكم لتعليم اللغة العربية </span>
              <h2 class="text-primary-dark text-[50px] leading-[60px] font-[800] mt-[6px] block">ساهم معنا بالإلتحاق</h2>
            </div>
            <p class="text-[16px]">في مدرستنا ستتعلم القران الكريم واللسان العربي الفصيح</p>
            <v-btn size="large" flat color="primary2" class="mt-[70px]">اكتشف المزيد</v-btn>

          </div>
        </v-col>
        <v-col cols="12" lg="6">
          <div class="right relative block">
            <div class="relative z-[2] flex justify-center xl:block">
              <img :src="Image1" class="w-full rounded-[50%] max-w-[440px] xl:max-w-full">
            </div>
            <div class="absolute bottom-[-75px] right-[-95px] z-[2] hidden xl:block">
              <img :src="Image2" class="w-auto rounded-[50%]">
            </div>
            <div class="counter absolute bottom-[-118px] left-[92px] h-[205px] w-[290px] z-[3] hidden xl:block">
              <h3 class="text-primary font-[700] text-[80px]">90+</h3>
              <p>لدينا اكثر من تسعين  طالب من مختلف الجنسيات</p>
            </div>
            <div class="about-border absolute top-[3px] left-[-8px] w-[604px] h-[604px] border-2 border-solid border-[#ddd] rounded-[50%] z-[1] hidden xl:block"></div>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </section>
</template>

<style scoped>

</style>
