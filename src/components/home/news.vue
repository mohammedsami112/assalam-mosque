<script setup>
  import { ref } from 'vue'
  import {useAppStore} from "@/store/app";
  import { usePostsStore } from "@/store/posts";
  import moment from 'moment'
  import PostsApi from '@/controllers/posts'
  import { Swiper, SwiperSlide } from "swiper/vue";
  import 'swiper/css'

  const AppStore = useAppStore()
  const PostsStore = usePostsStore()

  const categoryId = ref(1)
  const loading = ref(false)

  const getPosts = (category) => {

    categoryId.value = category
    loading.value = true

    PostsApi.getPosts(category).then(response => {
      PostsStore.setPosts(response.data)
    }).finally(() => {
      loading.value = false
    })

  }

</script>

<template>
  <section class="section news-section relative" id="news">
    <v-container>
      <div class="section-title text-center relative block mb-[46px]">
        <span class="block text-[20px] text-primary font-[700] leading-[24px] mb-[10px]">أخر الأنشطة</span>
        <h2 class="block text-primary-dark text-[30px] leading-[60px] font-[900] mt-[6px]">أحدث الفعاليات في الملتقي</h2>
      </div>
      <div class="tabs mb-5">
        <v-row>
          <v-col cols="12" lg="6">
            <div class="tab flex justify-center items-center h-[100px] bg-[#f7f7f7] rounded-[9px] cursor-pointer transition-all duration-500 ease-in-out" :class="{active: categoryId == 2}" @click="getPosts(2)">
              <h3>اخبار الجمعية</h3>
            </div>
          </v-col>
          <v-col cols="12" lg="6">
            <div class="tab flex justify-center items-center h-[100px] bg-[#f7f7f7] rounded-[9px] cursor-pointer transition-all duration-500 ease-in-out" :class="{active: categoryId == 1}" @click="getPosts(1)">
              <h3>فعليات الجمعية</h3>
            </div>
          </v-col>
        </v-row>
      </div>
      <swiper
        v-if="!loading"
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
        <swiper-slide v-for="item in PostsStore.posts" :key="item.id">
          <div class="news-card relative block">
            <div class="thumbnail relative block overflow-hidden rounded-tl-[20px] rounded-tr-[20px] z-[1] h-[250px]">
              <img class="w-full h-full transition-all duration-500 ease-in-out" :src="item.thumbnail" alt="">
            </div>
            <div class="content relative block border-[1px] border-t-0 border-[#eee9db] rounded-bl-[20px] rounded-br-[20px] bg-white transition-all duration-500 ease-in-out">

              <div class="inner-content relative block overflow-hidden">
                <div class="top relative block pt-[37px] pr-[25px] pb-[23px] pl-[25px]">
                  <ul class="relative flex items-center">
                    <li class="text-[14px] text-[#6f7775] font-[600] transition-all duration-500 ease-in-out">
                      <span class="mdi mdi-account-circle pr-[3px] text-primary2"></span>
                      {{ item.post_author.name }}
                    </li>
                  </ul>
                  <h3 class="mt-[3px]">
                    <router-link :to="{name: 'posts-page', params: {id: item.id, slug: item.slug}}" class="text-primary-dark text-[26px] font-[900] leading-[31px]">{{ item.title }}</router-link>
                  </h3>
                </div>
                <div class="bottom relative flex items-center justify-between border-t-[1px] border-t-solid border-t-[#eee9db] pt-[19px] pb-[19px] pr-[27px] pl-[27px]">
                  <div class="read-more relative">
                    <router-link :to="{name: 'posts-page', params: {id: item.id, slug: item.slug}}" class="text-[14px] font-[700] text-primary-dark">
                      <span class="mdi mdi-arrow-right-thin text-[16px] pr-[6px] relative top-[2px]"></span>
                      اقرأ المزيد
                    </router-link>
                  </div>
                </div>
              </div>

              <div class="date absolute left-[30px] top-[-15px] bg-white pt-[6px] pr-[25px] pb-[6px] pl-[25px] rounded-[15px] z-[2]" style="box-shadow: 0px 4px 7px 0px rgba(0, 0, 0, 0.1);">
                <p class="text-[18px] text-primary font-[700] leading-[18px]">{{ moment(item.created_at).format('ddd MMM, YYYY') }}</p>
              </div>
            </div>
          </div>
        </swiper-slide>
      </swiper>
      <div v-else class="w-full h-full flex justify-center items-center">
        <v-progress-circular
          color="primary"
          indeterminate
          :size="83"
          :width="5"

        ></v-progress-circular>
      </div>
    </v-container>
  </section>
</template>

<style lang="scss" scoped>
  @import "@/assets/scss/_vars.scss";
  .tabs {
    .tab {
      &.active {
        background: $primary2;
      }
    }
  }
</style>
