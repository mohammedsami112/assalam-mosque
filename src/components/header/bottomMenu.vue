<script setup>
  import { defineProps } from 'vue'

  const props = defineProps(['menuItems'])
</script>

<template>
  <div class="bottom flex items-center justify-between">
    <div class="menu block bg-primary pl-[50px] rounded-tl-[15px] rounded-tr-[15px] w-full">
      <ul class="flex">
        <li class="pt-[17px] pb-[17px] relative" v-for="(item, index) in props.menuItems" :key="index">
          <router-link to="/" class="font-[400] text-[16px] flex items-center relative transition-all ease-in-out duration-500 text-gray-300 hover:text-white">{{ item.title }}</router-link>
        </li>

      </ul>
    </div>
<!--    <div class="content-box block relative">-->
<!--      <div class="btn-content-box flex items-center">-->
<!--        <div class="btn-box relative flex items-center z-[1]">-->
<!--          <router-link to="/" class="bg-primary2 text-primary-dark text-[14px] font-[400] pt-[17px] pb-[17px] w-[9%] relative flex items-center">-->
<!--            <span class="mdi mdi-heart"></span>-->
<!--            تبــرع الآن-->
<!--          </router-link>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->

  </div>
</template>

