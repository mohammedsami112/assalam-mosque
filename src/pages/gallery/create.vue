<script setup>
import GalleryApi from '@/controllers/gallery'
import { useToast } from 'vue-toastification'
import { useRouter } from 'vue-router'
import { required, helpers, minLength } from '@vuelidate/validators'
import useVuelidate from '@vuelidate/core'

const isLoading = ref(false)
const toast = useToast()
const router = useRouter()

const handelImage = (event) => {
  inputs.image = event.target.files[0]
}

const inputs = reactive({
  image: null,
})

const $externalResults = ref({})

const rules = computed(() => ({
  image: { required: helpers.withMessage('Image Is Required', required) },
}))

const validate = useVuelidate(rules, inputs, {$externalResults})

const createImage = () => {
  validate.value.$clearExternalResults()
  validate.value.$touch()
  if (!validate.value.$error) {
    $externalResults.value = {}
    isLoading.value = true

    GalleryApi.manageImages(inputs).then(response => {
      toast.success(response.message)
      router.push({name: 'view-gallery'})
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
        Add New Image
      </v-card-title>
    </v-card-item>

    <v-card-text>
      <VForm @submit.prevent="createImage()">
        <VRow>
          <VCol cols="12">
              <VFileInput
                clearable
                :disabled='isLoading'
                accept="image/*"
                label="Image"
                variant="outlined"
                @change = "handelImage"
              ></VFileInput>
          </VCol>

          <VCol cols='12'>
            <VBtn
              :loading='isLoading'
              block
              type="submit"
              class='mt-4'

            >
              Add Image
            </VBtn>
          </VCol>



        </VRow>
      </VForm>
    </v-card-text>
  </VCard>
</template>
