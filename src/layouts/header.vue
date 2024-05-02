<script setup>
  import { watch, reactive, ref } from 'vue'
  import AppLogo from '@/assets/images/logo.png'
  import HeaderTopMenu from '@/components/header/topMenu.vue'
  import HeaderBottomMenu from '@/components/header/bottomMenu.vue'
  import MobileMenu from '@/components/header/mobileMenu'
  import SocialIcons from "@/components/header/socialIcons";
  import { useAppStore } from "@/store/app";

  const AppStore = useAppStore()

  const menuItems = ref([
    {
      title: 'Hauptsächlich',
      route: 'home-page',
      hash: false

    },
    {
      title: 'Bildungszentrum\n',
      route: {
        path: '/',
        hash: '#about'
      },
      hash: true
    },
    {
      title: 'Spenden',
      route: {
        path: '/',
        hash: '#donations'
      },
      hash: true
    },
    {
      title: 'Letzte Veranstaltungen',
      route: {
        path: '/',
        hash: '#news'
      },
      hash: true
    },

    // {
    //   title: 'اوقات الصلاه',
    //   route: 'prayer-page',
    //   hash: false
    // },
  ])
  const mainSettings = reactive({
    phone: null,
    email: null,
    google_map: null,
    facebook: null,
    youtube: null,
    instagram: null,
  })
  watch(() => AppStore.home, (home) => {
    mainSettings.phone = home.settings.filter(setting => setting.name == 'phone_number')[0].value.replace('+', '');
    mainSettings.google_map = home.settings.filter(setting => setting.name == 'google_map')[0].value;
    mainSettings.facebook = home.settings.filter(setting => setting.name == 'facebook')[0].value;
    mainSettings.youtube = home.settings.filter(setting => setting.name == 'youtube')[0].value;
    mainSettings.instagram = home.settings.filter(setting => setting.name == 'instagram')[0].value;

  }, {deep: true})

</script>

<template>
  <header class="block">
    <v-container class="xl:!pb-0">
      <div class="flex items-center justify-center flex-column xl:!flex-row xl:!justify-between">
        <div class="left relative block max-w-[75px] mb-3 xl:!mb-0 xl:max-w-full xl:w-[9%] xl:mr-[100px]">
          <div class="logo">
            <router-link :to="{name: 'home-page'}">
              <img class="w-full" :src="AppLogo" alt="">
            </router-link>
          </div>
        </div>
<!--        <v-btn class="!flex xl:!hidden"  prepend-icon="mdi mdi-heart" flat color="primary2" :to="{name: 'donation-page'}">تبرع الان</v-btn>-->
        <div class="right xl:w-[91%] block">
          <HeaderTopMenu :mainSettings="mainSettings"></HeaderTopMenu>
          <HeaderBottomMenu :menuItems="menuItems"></HeaderBottomMenu>
          <MobileMenu :menuItems="menuItems" :mainSettings="mainSettings"></MobileMenu>

        </div>
        <div class="block xl:hidden mt-3"><SocialIcons :socials="mainSettings"></SocialIcons></div>
      </div>
    </v-container>
  </header>
</template>
