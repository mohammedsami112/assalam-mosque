<script setup>
import DonationTypesApi from '@/controllers/donationTypes'
import { useToast } from 'vue-toastification'
import { useRouter } from 'vue-router'
import { required, helpers, sameAs } from '@vuelidate/validators'
import useVuelidate from '@vuelidate/core'

const fetchDonationTypeLoading = ref(true)
const isLoading = ref(false)
const toast = useToast()
const router = useRouter()

const type = ref({})
const getType = () => {
  DonationTypesApi.getType(router.currentRoute.value.params.id).then(response => {
    type.value = response.data
    inputs.item_id = type.value.id
    inputs.title = type.value.title
  }).finally(() => {
    fetchDonationTypeLoading.value = false
  })
}

const handelThumbnail = (event) => {
  inputs.thumbnail = event.target.files[0]
}

const inputs = reactive({
  item_id: null,
  title: null,
  thumbnail: null,
})

const $externalResults = ref({})

const rules = computed(() => ({
  title: { required: helpers.withMessage('Title Is Required', required) },
}))

const validate = useVuelidate(rules, inputs, {$externalResults})

const updateType = () => {
  validate.value.$clearExternalResults()
  validate.value.$touch()
  if (!validate.value.$error) {
    $externalResults.value = {}
    isLoading.value = true

    DonationTypesApi.manageDonationTypes(inputs).then(response => {
      toast.success(response.message)
      router.push({name: 'view-donation-types'})
    }).catch(error => {
      $externalResults.value = error.response.data.data
      toast.error(error.response.data.message)
    }).finally(() => {
      isLoading.value = false
    })

  }

}



onMounted(() => {
  if (!router.currentRoute.value.params.id) {
    router.push({name: 'view-donation-types'})
  }

  getType()
})

</script>

<template>
  <VCard :loading='fetchDonationTypeLoading'>

    <v-card-item>
      <v-card-title>
        Edit Type : {{ type.title }}
      </v-card-title>
    </v-card-item>

    <v-card-text>
      <VForm @submit.prevent="updateType()">
        <VRow>
          <VCol cols="12">
            <VTextField
              :disabled='isLoading'
              :error-messages='validate.title.$errors.map(e => e.$message)'
              @input="validate.title.$touch"
              @blur="validate.title.$touch"
              v-model="inputs.title"
              label="Title"
              type="text"
              required

            />
          </VCol>
          <VCol cols="12">
            <VFileInput

              clearable
              :disabled='isLoading'
              accept="image/*"
              label="Thumbnail"
              variant="outlined"
              @change = "handelThumbnail"
            ></VFileInput>
            <img style='width: 100%; border-radius: 5px;max-width: 300px' class='mt-3' :src="type.thumbnail">
          </VCol>

          <VCol cols='12'>
            <VBtn
              :loading='isLoading'
              block
              type="submit"
              class='mt-4'

            >
              Update Donation Type
            </VBtn>
          </VCol>



        </VRow>
      </VForm>
    </v-card-text>
  </VCard>
</template>
