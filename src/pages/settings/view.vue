<script setup>
  import SettingsApi from '@/controllers/settings'
  import { useToast } from 'vue-toastification'
  import { required, helpers, sameAs, email } from '@vuelidate/validators'
  import useVuelidate from '@vuelidate/core'
  import UsersApi from '@/controllers/users.js'

  const isLoading = ref(false)
  const toast = useToast()

  const getSettings = () => {
    isLoading.value = true;
    SettingsApi.getSettings().then(response => {
      let settingsData = response.data

      inputs.phone_number = settingsData.filter(setting => setting.name == 'phone_number')[0].value
      inputs.email = settingsData.filter(setting => setting.name == 'email')[0].value
      inputs.google_map = settingsData.filter(setting => setting.name == 'google_map')[0].value
      inputs.facebook = settingsData.filter(setting => setting.name == 'facebook')[0].value
      inputs.youtube = settingsData.filter(setting => setting.name == 'youtube')[0].value
      inputs.instagram = settingsData.filter(setting => setting.name == 'instagram')[0].value
      inputs.stripe_secret_key = settingsData.filter(setting => setting.name == 'stripe_secret_key')[0].value
      inputs.stripe_publish_key = settingsData.filter(setting => setting.name == 'stripe_publish_key')[0].value
      inputs.paypal_mode = settingsData.filter(setting => setting.name == 'paypal_mode')[0].value
      inputs.paypal_client_id = settingsData.filter(setting => setting.name == 'paypal_client_id')[0].value
      inputs.paypal_secret_id = settingsData.filter(setting => setting.name == 'paypal_secret_id')[0].value
      inputs.paypal_app_id = settingsData.filter(setting => setting.name == 'paypal_app_id')[0].value

    }).finally(() => {
      isLoading.value = false
    })
  }

  const inputs = reactive({
    phone_number: null,
    email: null,
    google_map: null,
    facebook: null,
    youtube: null,
    instagram: null,
    stripe_secret_key: null,
    stripe_publish_key: null,
    paypal_mode: null,
    paypal_client_id: null,
    paypal_secret_id: null,
    paypal_app_id: null,
  })

  const $externalResults = ref({})

  const rules = computed(() => ({
    email: {
      email: helpers.withMessage('Email Invalid', email)
    },
    stripe_secret_key: { required: helpers.withMessage('Stripe Secret Key Is Required', required) },
    stripe_publish_key: { required: helpers.withMessage('Stripe Publish Key Is Required', required) },
    paypal_mode: { required: helpers.withMessage('Paypal Mode Is Required', required) },
    paypal_client_id: { required: helpers.withMessage('Paypal Client Id Is Required', required) },
    paypal_secret_id: { required: helpers.withMessage('Paypal Secret Id Is Required', required) },
    paypal_app_id: { required: helpers.withMessage('Paypal App Id Is Required', required) },
  }))

  const validate = useVuelidate(rules, inputs, {$externalResults})

  const updateSettings = () => {
    validate.value.$clearExternalResults()
    validate.value.$touch()
    if (!validate.value.$error) {
      $externalResults.value = {}
      isLoading.value = true

      SettingsApi.updateSettings(inputs).then(response => {
        toast.success(response.message)
      }).catch(error => {
        $externalResults.value = error.response.data.data
        toast.error(error.response.data.message)
      }).finally(() => {
        isLoading.value = false
      })

    }
  }


  onMounted(() => {
    getSettings()
  })

</script>

<template>

  <VCard :loading='isLoading'>
    <v-card-item>
      <v-card-title>
        Settings
      </v-card-title>
    </v-card-item>
    <v-card-text>

      <VForm @submit.prevent='updateSettings()'>
        <v-card-title>
          Contact Info
        </v-card-title>
        <VRow class='mt-6 mb-6'>
          <VCol cols="12" lg='6'>
            <VTextField
              :disabled='isLoading'
              v-model="inputs.phone_number"
              label="Phone Number"
              type="text"
              required

            />
          </VCol>
          <VCol cols="12" lg='6'>
            <VTextField
              :disabled='isLoading'
              :error-messages='validate.email.$errors.map(e => e.$message)'
              @input="validate.email.$touch"
              @blur="validate.email.$touch"
              v-model="inputs.email"
              label="Email"
              type="text"
              required

            />
          </VCol>
          <VCol cols="12" lg='6'>
            <VTextField
              :disabled='isLoading'
              v-model="inputs.google_map"
              label="Google Maps Link"
              type="text"
              required

            />
          </VCol>
          <VCol cols="12" lg='6'>
            <VTextField
              :disabled='isLoading'
              v-model="inputs.facebook"
              label="Facebook Page"
              type="text"
              required

            />
          </VCol>
          <VCol cols="12" lg='6'>
            <VTextField
              :disabled='isLoading'
              v-model="inputs.youtube"
              label="Youtube Channel"
              type="text"
              required

            />
          </VCol>
          <VCol cols="12" lg='6'>
            <VTextField
              :disabled='isLoading'
              v-model="inputs.instagram"
              label="Instagram"
              type="text"
              required

            />
          </VCol>
        </VRow>

        <v-card-title>
          Stripe Config
        </v-card-title>
        <VRow class='mt-6 mb-6'>
          <VCol cols="12" lg='6'>
            <VTextField
              :disabled='isLoading'
              :error-messages='validate.stripe_secret_key.$errors.map(e => e.$message)'
              @input="validate.stripe_secret_key.$touch"
              @blur="validate.stripe_secret_key.$touch"
              v-model="inputs.stripe_secret_key"
              label="Stripe Secret Key"
              type="text"
              required

            />
          </VCol>
          <VCol cols="12" lg='6'>
            <VTextField
              :disabled='isLoading'
              :error-messages='validate.stripe_publish_key.$errors.map(e => e.$message)'
              @input="validate.stripe_publish_key.$touch"
              @blur="validate.stripe_publish_key.$touch"
              v-model="inputs.stripe_publish_key"
              label="Stripe Publish Key"
              type="text"
              required

            />
          </VCol>
        </VRow>

        <v-card-title>
          Paypal Config
        </v-card-title>
        <VRow class='mt-6 mb-6'>
          <VCol cols="12" lg='6'>
            <VTextField
              :disabled='isLoading'
              :error-messages='validate.paypal_mode.$errors.map(e => e.$message)'
              @input="validate.paypal_mode.$touch"
              @blur="validate.paypal_mode.$touch"
              v-model="inputs.paypal_mode"
              label="Paypal Mode"
              type="text"
              required

            />
          </VCol>
          <VCol cols="12" lg='6'>
            <VTextField
              :disabled='isLoading'
              :error-messages='validate.paypal_client_id.$errors.map(e => e.$message)'
              @input="validate.paypal_client_id.$touch"
              @blur="validate.paypal_client_id.$touch"
              v-model="inputs.paypal_client_id"
              label="Paypal Client Id"
              type="text"
              required
            />
          </VCol>
          <VCol cols="12" lg='6'>
            <VTextField
              :disabled='isLoading'
              :error-messages='validate.paypal_secret_id.$errors.map(e => e.$message)'
              @input="validate.paypal_secret_id.$touch"
              @blur="validate.paypal_secret_id.$touch"
              v-model="inputs.paypal_secret_id"
              label="Paypal Secret Id"
              type="text"
              required
            />
          </VCol>
          <VCol cols="12" lg='6'>
            <VTextField
              :disabled='isLoading'
              :error-messages='validate.paypal_app_id.$errors.map(e => e.$message)'
              @input="validate.paypal_app_id.$touch"
              @blur="validate.paypal_app_id.$touch"
              v-model="inputs.paypal_app_id"
              label="Paypal App Id"
              type="text"
              required
            />
          </VCol>
        </VRow>
        <VBtn
          :loading='isLoading'
          block
          type="submit"
          class='mt-4'

        >
          Update Settings
        </VBtn>
      </VForm>
    </v-card-text>
  </VCard>

</template>

