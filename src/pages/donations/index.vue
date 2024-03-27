<script setup>
  import { onMounted } from "vue";
  import { useDonationStore } from "@/store/donations";
  import DonationApi from '@/controllers/donations'
  import PageHeader from '@/components/global/pageHeader'
  import LatestDonations from '@/components/donations/latestDonations'
  import Donate from '@/components/donations/donate'

  const donationStore = useDonationStore()

  onMounted(() => {
    DonationApi.getLatestDonations().then(response => {
      donationStore.setDonations(response.data)
    })
    DonationApi.getDonationTypes().then(response => {
      donationStore.setDonationTypes(response.data)
    })
  })
</script>

<template>
  <PageHeader title="التبراعات" />
  <v-container>
    <Donate />
    <LatestDonations />
  </v-container>
</template>
