<script setup>
import DonationTypesApi from '@/controllers/donationTypes'
import { useToast } from 'vue-toastification'
import { useRouter } from 'vue-router'
import { required, helpers, minLength } from '@vuelidate/validators'
import useVuelidate from '@vuelidate/core'

const isLoading = ref(false)
const toast = useToast()
const router = useRouter()

const handelThumbnail = (event) => {
  inputs.thumbnail = event.target.files[0]
}

const inputs = reactive({
  title: null,
  thumbnail: null,
})

const $externalResults = ref({})

const rules = computed(() => ({
  title: { required: helpers.withMessage('Title Is Required', required) },
  thumbnail: { required: helpers.withMessage('Thumbnail Is Required', required) },
}))

const validate = useVuelidate(rules, inputs, {$externalResults})

const createDonationType = () => {
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

</script>

<template>
  <VCard>

    <v-card-item>
      <v-card-title>
        Add New Type
      </v-card-title>
    </v-card-item>

    <v-card-text>
      <VForm @submit.prevent="createDonationType()">
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
                :error-messages='validate.thumbnail.$errors.map(e => e.$message)'
                @input="validate.thumbnail.$touch"
                @blur="validate.thumbnail.$touch"
                clearable
                :disabled='isLoading'
                accept="image/*"
                label="Thumbnail"
                variant="outlined"
                @change = "handelThumbnail"
              ></VFileInput>
          </VCol>

          <VCol cols='12'>
            <VBtn
              :loading='isLoading'
              block
              type="submit"
              class='mt-4'

            >
              Create Donation Type
            </VBtn>
          </VCol>



        </VRow>
      </VForm>
    </v-card-text>
  </VCard>
</template>
