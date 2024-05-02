<script setup>
  import { onMounted, reactive, computed, ref } from "vue";
  import { useRouter } from 'vue-router'
  import { useDonationStore } from "@/store/donations";
  import { useVuelidate } from "@vuelidate/core"
  import { required, helpers, email, numeric } from '@vuelidate/validators'
  import DonationApi from '@/controllers/donations'

  import PayPalLogo from '@/assets/images/donations/paypal.svg'
  import VisaMastercardLogo from '@/assets/images/donations/visa-master.svg'

  const isLoading = ref(false)
  const router = useRouter()
  const donationStore = useDonationStore()

  const payload = reactive({
    method: 'visa-mastercard',
    amount: null,
    type: null,
    name: null,
    email: null,
    show_name: false
  })

  const $externalResults = ref({})

  const rules = computed(() => ({
    amount: {
      required: helpers.withMessage('Das Betragsfeld ist erforderlich', required),
      numeric: helpers.withMessage('Der Betrag ist falsch', numeric),
    },
    // type: {
    //   required: helpers.withMessage('حقل نوع التبرع مطلوب', required),
    // },
    name: {
      required: helpers.withMessage('Das Namensfeld ist erforderlich', required),
    },
    email: {
      required: helpers.withMessage('Das E-Mail-Feld ist erforderlich', required),
      email: helpers.withMessage('E-Mail ist ungültig', email)
    },

  }))

  const v$ = useVuelidate(rules, payload, { $externalResults })


  const makeCardPayment = () => {
    v$.value.$clearExternalResults()
    v$.value.$touch()

    if (!v$.value.$error) {
      $externalResults.value = {}
      isLoading.value = true
      DonationApi.makeDonation(payload).then(response => {
        window.location.replace(response);
      }).finally(() => {
        isLoading.value = false
      })

    }

  }

  const changeTabs = (value) => {
    payload.method = value
  }



  onMounted(() => {
    payload.type = !router.currentRoute.value.params.type || router.currentRoute.value.params.type == "" ? null : parseInt(router.currentRoute.value.params.type)
  })

</script>

<template>
  <div class="donate-box mb-10">
    <div class="tabs mb-5">
      <v-row>
        <v-col cols="12" lg="6">
          <div class="tab flex justify-center items-center h-[100px] bg-[#f7f7f7] rounded-[9px] cursor-pointer transition-all duration-500 ease-in-out" :class="{active: payload.method == 'paypal'}" @click="changeTabs('paypal')">
<!--            <img class="w-[150px]" :src="PayPalLogo" alt="">-->
            <h3 class="text-xl">PayPal</h3>
          </div>
        </v-col>
        <v-col cols="12" lg="6">
          <div class="tab flex justify-center items-center h-[100px] bg-[#f7f7f7] rounded-[9px] cursor-pointer transition-all duration-500 ease-in-out" :class="{active: payload.method == 'visa-mastercard'}" @click="changeTabs('visa-mastercard')">
<!--            <img class="w-[200px]" :src="VisaMastercardLogo" alt="">-->
            <h3 class="text-xl">Bankkarten</h3>
          </div>
        </v-col>
      </v-row>
    </div>
    <div class="box bg-[#f7f7f7] rounded-[9px] p-[20px]">
      <div class="donate-box" v-if="payload.method == 'paypal'">
        <v-row style="direction: rtl">
          <v-col cols="12">
            <v-text-field :disabled="isLoading" v-model="payload.amount" label="die Summe" color="primary" variant="solo" flat :error-messages="v$.amount.$errors.map(e => e.$message)" @blur="v$.amount.$touch" @input="v$.amount.$touch"></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-select :disabled="isLoading" clearable label="Wählen Sie die Spendenart" v-model="payload.type" :items="donationStore.types" item-title="title" item-value="id" variant="solo" color="primary" flat></v-select>
          </v-col>
          <v-col cols="12" lg="4">
            <v-text-field :disabled="isLoading" v-model="payload.name" label="Der Name" color="primary" variant="solo" flat :error-messages="v$.name.$errors.map(e => e.$message)" @blur="v$.name.$touch" @input="v$.name.$touch"></v-text-field>
          </v-col>
          <v-col cols="12" lg="4">
            <v-text-field :disabled="isLoading" v-model="payload.email" label="E-Mail" color="primary" variant="solo" flat :error-messages="v$.email.$errors.map(e => e.$message)" @blur="v$.email.$touch" @input="v$.email.$touch"></v-text-field>
          </v-col>
          <v-col cols="12" lg="4" class="flex justify-center items-center">
            <v-switch :disabled="isLoading" v-model="payload.show_name" label="Name anzeigen" inset color="primary"></v-switch>
          </v-col>
          <v-col cols="12">
            <v-btn :loading="isLoading" size="x-large" flat color="primary" block @click="makeCardPayment()">Bezahlen Sie per PayPal</v-btn>
          </v-col>
        </v-row>
      </div>
      <div class="donate-box" v-if="payload.method == 'visa-mastercard'">
        <v-row style="direction: rtl">
          <v-col cols="12">
            <v-text-field :disabled="isLoading" v-model="payload.amount" label="die Summe" color="primary" variant="solo" flat :error-messages="v$.amount.$errors.map(e => e.$message)" @blur="v$.amount.$touch" @input="v$.amount.$touch"></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-select :disabled="isLoading" clearable label="Wählen Sie die Spendenart" v-model="payload.type" :items="donationStore.types" item-title="title" item-value="id" variant="solo" color="primary" flat></v-select>
          </v-col>
          <v-col cols="12" lg="4">
            <v-text-field :disabled="isLoading" v-model="payload.name" label="Der Name" color="primary" variant="solo" flat :error-messages="v$.name.$errors.map(e => e.$message)" @blur="v$.name.$touch" @input="v$.name.$touch"></v-text-field>
          </v-col>
          <v-col cols="12" lg="4">
            <v-text-field :disabled="isLoading" v-model="payload.email" label="E-Mail" color="primary" variant="solo" flat :error-messages="v$.email.$errors.map(e => e.$message)" @blur="v$.email.$touch" @input="v$.email.$touch"></v-text-field>
          </v-col>
          <v-col cols="12" lg="4" class="flex justify-center items-center">
            <v-switch :disabled="isLoading" v-model="payload.show_name" label="Name anzeigen" inset color="primary"></v-switch>
          </v-col>
          <v-col cols="12">
            <v-btn :loading="isLoading" size="x-large" flat color="primary" block @click="makeCardPayment()">Bezahlen Sie per Bankkarte</v-btn>
          </v-col>
        </v-row>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>

</style>
