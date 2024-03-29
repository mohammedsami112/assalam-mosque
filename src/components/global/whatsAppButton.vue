<script setup>
import {reactive, watch} from "vue";
import { useAppStore } from "@/store/app";

const AppStore = useAppStore()

const mainSettings = reactive({
  phone: null,
})
watch(() => AppStore.home, (home) => {
  mainSettings.phone = home.settings.filter(setting => setting.name == 'phone_number')[0].value.replace('+', '');
}, {deep: true})
</script>

<template>
  <div class="whatsapp-button fixed z-[30] right-[20px] bottom-[20px] ">
    <a :href="'https://api.whatsapp.com/send/?phone=' + mainSettings.phone">
      <div class="button absolute z-[31] bottom-[8px] right-[8px] h-[60px] min-w-[60px] max-w-[95vw] bg-[#25d366] rounded-[30px] cursor-pointer transition-all duration-500 ease-in-out">
        <div class="open rounded-[50%] w-[60px] h-[60px]"></div>
      </div>
    </a>
  </div>
</template>

<style scoped>

</style>
