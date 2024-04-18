<script setup>
  import { onMounted } from "vue";
  import { useDonationStore } from "@/store/donations";
  import { useToast } from "vue-toastification";
  import { useRouter } from 'vue-router'
  import DonationApi from '@/controllers/donations'
  import PageHeader from '@/components/global/pageHeader'
  import LatestDonations from '@/components/donations/latestDonations'
  import Donate from '@/components/donations/donate'

  const donationStore = useDonationStore()
  const toast = useToast()
  const router = useRouter()

  onMounted(() => {
    DonationApi.getLatestDonations().then(response => {
      donationStore.setDonations(response.data)
    })
    DonationApi.getDonationTypes().then(response => {
      donationStore.setDonationTypes(response.data)
    })

    if (router.currentRoute.value.query.payment_status && router.currentRoute.value.query.payment_status == 'success') {
      toast.success('شكرا لتبرعك')
    }
    if (router.currentRoute.value.query.payment_status && router.currentRoute.value.query.payment_status == 'fail') {
      toast.error('لقد حدث خطأ')
    }

  })
</script>

<template>
<!--  <PageHeader title="التبراعات" />-->
  <v-container>
    <Donate />
    <LatestDonations />
  </v-container>
</template>
