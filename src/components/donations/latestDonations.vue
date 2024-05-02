<script setup>
  import { useDonationStore } from "@/store/donations";
  const donationStore = useDonationStore()
</script>

<template>
  <div class="latest-donations">
    <div class="header text-right bg-[#dddddd4d] pt-[15px] pb-[15px] pr-[15px] rounded-tl-[15px] rounded-tr-[15px]">
      <h3 class="text-[25px] font-[600]">Neueste Spender</h3>
    </div>
    <div class="content">
      <div class="col flex items-center justify-between pl-[60px] pr-[60px] pt-[20px] pb-[20px]" v-for="item in donationStore.donations">
        <h3 class="text-[20px]">{{item.amount}} EUR</h3>
        <h3 class="text-[20px]">{{item.name}}</h3>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>
