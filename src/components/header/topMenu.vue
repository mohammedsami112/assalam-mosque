<script setup>
  import { defineProps } from 'vue'

  const props = defineProps(['mainSettings'])
</script>

<template>
  <div class="top flex items-center justify-between pt-[18px] pb-[18px]">
    <div class="left block">
      <div class="volunteers flex items-center">
        <div class="icon relative w-[44px] h-[44px] bg-primary2 rounded-[50%] flex items-center justify-center">
          <span class="mdi mdi-heart text-primary text-[24px]"></span>
        </div>
        <div class="text-box ml-[10px]">
          <p class="text-primary-dark  font-[700] text-[24px]">
            <span>كـــــن</span>
            مســـــاهما
          </p>
        </div>
      </div>
    </div>
    <div class="right flex items-center">
      <div class="info">
        <ul class="list-none flex items-center">
          <li class="flex items-center relative">
            <div class="icon flex relative items-center"><span class="mdi mdi-phone-in-talk-outline relative inline-block text-[36px] text-primary"></span></div>
            <div class="content ml-[15px]">
              <p class="text-[12px] font-[600] leading-[16px]">للإتصال</p>
              <h5 class="text-[14px] font-[700] leading-[20px]">
                <a class="text-primary-dark" :href="'tel:' + props.mainSettings.phone">{{ props.mainSettings.phone }}</a>
              </h5>
            </div>
          </li>
          <li class="flex items-center relative ml-[80px]">
            <div class="icon flex relative items-center"><span class="mdi mdi-email-open-outline relative inline-block text-[36px] text-primary"></span></div>
            <div class="content ml-[15px]">
              <p class="text-[12px] font-[600] leading-[16px]">البريد الالكتروني</p>
              <h5 class="text-[14px] font-[700] leading-[20px]">
                <a class="text-primary-dark" :href="'mailto:' + props.mainSettings.email">{{ props.mainSettings.email }}</a>
              </h5>
            </div>
          </li>
          <li class="flex items-center relative ml-[80px]">
            <div class="icon flex relative items-center"><span class="mdi mdi-map-marker-outline relative inline-block text-[36px] text-primary"></span></div>
            <div class="content ml-[15px]">
              <p class="text-[12px] font-[600] leading-[16px]">{{ props.mainSettings.address1 }}</p>
              <h5 class="text-[14px] font-[700] leading-[20px]">
                <a class="text-primary-dark" >{{ props.mainSettings.address2 }}</a>
              </h5>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>
