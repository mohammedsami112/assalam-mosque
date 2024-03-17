<script setup>
  import { watch, reactive, ref } from 'vue'
  import AppLogo from '@/assets/logo.png'
  import HeaderTopMenu from '@/components/header/topMenu.vue'
  import HeaderBottomMenu from '@/components/header/bottomMenu.vue'
  import { useAppStore } from "@/store/app";

  const AppStore = useAppStore()

  const menuItems = ref([
    {
      title: 'الرئيسية'
    },
    {
      title: 'المركز التعليمي'
    },
    {
      title: 'التبرعات'
    },
    {
      title: 'احدث الفعاليات'
    },
    {
      title: 'من نحن'
    },
    {
      title: 'تواصل معنا'
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
  <header class="block relative">
    <v-container>
      <div class="flex items-center justify-between">
        <div class="left relative block w-[9%] mr-[100px]">
          <div class="logo">
            <router-link :to="{name: 'home-page'}">
              <img :src="AppLogo" alt="">
            </router-link>
          </div>
        </div>
        <div class="right block w-[91%]">
          <HeaderTopMenu :mainSettings="mainSettings"></HeaderTopMenu>
          <HeaderBottomMenu :menuItems="menuItems"></HeaderBottomMenu>
        </div>
      </div>
    </v-container>
  </header>
</template>
