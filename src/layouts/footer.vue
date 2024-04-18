<script setup>
  import AppLogo from '@/assets/images/logo.png'
  import FooterCopyrights from '@/components/footer/copyrights'
  import {useAppStore} from "@/store/app";
  import {reactive, watch} from "vue";

  const AppStore = useAppStore()


  const mainSettings = reactive({
    phone: null,
    email: null,
    address1: null,
    address2: null,
  })
  watch(() => AppStore.home, (home) => {
    mainSettings.phone = home.settings.filter(setting => setting.name == 'phone_number')[0].value;
    // mainSettings.email = home.settings.filter(setting => setting.name == 'email')[0].value;
    // mainSettings.address1 = home.settings.filter(setting => setting.name == 'address1')[0].value;
    // mainSettings.address2 = home.settings.filter(setting => setting.name == 'address2')[0].value;
  }, {deep: true})
</script>

<template>
  <footer class="border-t-[3px] border-t-solid border-t-[#333] pt-[60px]">
    <v-container>
      <v-row class="flex-row-reverse justify-center">

        <v-col cols="12" lg="2" class="flex justify-center items-center">
          <div class="footer-widget">
            <img width="75" :src="AppLogo" class="mb-4">
          </div>
        </v-col>
        <v-col cols="12" lg="8" class="flex justify-center items-center">
          <div class="footer-widget mb-10">
            <p class="" style="direction: rtl">
              التطرف.
              <br>
              يدين مسجد السلام والملتقى العربي في النمسا بسانكت بولتن جميع الأفكار المتطرفة و يرفض الجرائم المرتكبة باسم الإسلام - دين السلام -. الأشخاص الذين يمثلون مثل هذه المواقف أو ينشرون دعاية عنيفة وبغيضة غير مرحب بهم في مسجد السلام و الملتقى العربي في النمسا
            </p>
          </div>
        </v-col>
      </v-row>
    </v-container>
    <FooterCopyrights />
  </footer>
</template>

<style scoped>

</style>
