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
    mainSettings.email = home.settings.filter(setting => setting.name == 'email')[0].value;
    mainSettings.address1 = home.settings.filter(setting => setting.name == 'address1')[0].value;
    mainSettings.address2 = home.settings.filter(setting => setting.name == 'address2')[0].value;
  }, {deep: true})
</script>

<template>
  <footer class="border-t-[3px] border-t-solid border-t-[#333] pt-[60px]">
    <v-container>
      <v-row>
        <v-col cols="12" lg="6">
          <div class="footer-widget mb-10">
            <img :src="AppLogo" class="mb-4">
            <p class="mb-10 text-[14px]">قال النبي صلى الله عليه وسلم : ( مَنْ بَنَى مَسْجِدًا بَنَى اللَّهُ لَهُ مِثْلَهُ فِي الْجَنَّةِ ) رواه البخاري</p>
            <v-btn size="x-large" prepend-icon="mdi mdi-heart" flat color="primary2">تبرع الان</v-btn>
          </div>
        </v-col>
        <v-col cols="12" lg="6">
          <div class="footer-widget">
            <h3 class="text-primary-dark text-[20px] font-[800] leading-[20px] mb-[10px]">Contact</h3>
            <ul>
              <li class="mb-5">
                <p>
                  {{ mainSettings.address1 }}
                  <br>
                  {{ mainSettings.address2 }}
                </p>
              </li>
              <li class="flex items-center mb-3">
                <span class="mdi mdi-email-open block pr-[14px] text-[20px] text-primary2"></span>
                <a class="text-primary-dark" :href="'mailto:' + mainSettings.email">{{ mainSettings.email }}</a>
              </li>
              <li class="flex items-center">
                <span class="mdi mdi-phone-in-talk block pr-[14px] text-[20px] text-primary2"></span>
                <a class="text-primary-dark" :href="'tel:' + mainSettings.phone">{{ mainSettings.phone }}</a>
              </li>
            </ul>
          </div>
        </v-col>
      </v-row>
    </v-container>
    <FooterCopyrights />
  </footer>
</template>

<style scoped>

</style>
