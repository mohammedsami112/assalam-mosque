<script setup>
  import { watch, reactive, ref } from 'vue'
  import AppLogo from '@/assets/images/logo.png'
  import HeaderTopMenu from '@/components/header/topMenu.vue'
  import HeaderBottomMenu from '@/components/header/bottomMenu.vue'
  import MobileMenu from '@/components/header/mobileMenu'
  import { useAppStore } from "@/store/app";

  const AppStore = useAppStore()

  const menuItems = ref([
    {
      title: 'الرئيسية',
      route: 'home-page',
      hash: false

    },
    {
      title: 'المركز التعليمي',
      route: {
        path: '/',
        hash: '#about'
      },
      hash: true
    },
    {
      title: 'التبرعات',
      route: {
        path: '/',
        hash: '#donations'
      },
      hash: true
    },
    {
      title: 'احدث الفعاليات',
      route: {
        path: '/',
        hash: '#news'
      },
      hash: true
    },

    {
      title: 'اوقات الصلاه',
      route: 'prayer-page',
      hash: false
    },
  ])
  const mainSettings = reactive({
    phone: null,
    email: null,
    address1: null,
    address2: null,
  })
  watch(() => AppStore.home, (home) => {
    mainSettings.phone = home.settings.filter(setting => setting.name == 'phone_number')[0].value;
    mainSettings.email = home.settings.filter(setting => setting.name == 'email')[0].value;
    mainSettings.address1 = home.settings.filter(setting => setting.name == 'address1')[0].value;
    mainSettings.address2 = home.settings.filter(setting => setting.name == 'address2')[0].value;
  }, {deep: true})

</script>

<template>
  <header class="block">
    <v-container class="pb-0">
      <div class="flex items-center justify-between">
        <div class="left relative block max-w-[75px] xl:max-w-full xl:w-[9%] xl:mr-[100px]">
          <div class="logo">
            <router-link :to="{name: 'home-page'}">
              <img class="w-full" :src="AppLogo" alt="">
            </router-link>
          </div>
        </div>
        <div class="right xl:w-[91%] block">
          <HeaderTopMenu :mainSettings="mainSettings"></HeaderTopMenu>
          <HeaderBottomMenu :menuItems="menuItems"></HeaderBottomMenu>
          <MobileMenu :menuItems="menuItems" :mainSettings="mainSettings"></MobileMenu>
        </div>
      </div>
    </v-container>
  </header>
</template>
