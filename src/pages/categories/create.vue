<script setup>
import CategoriesApi from '@/controllers/categories'
import { useToast } from 'vue-toastification'
import { useRouter } from 'vue-router'
import { required, helpers, minLength } from '@vuelidate/validators'
import useVuelidate from '@vuelidate/core'
import GlobalApi from '@/controllers/global'

const categoriesList = ref([]);
const isLoading = ref(false)
const toast = useToast()
const router = useRouter()

const inputs = reactive({
  title: null,
  parent: null,
  description: null,
})

const $externalResults = ref({})

const rules = computed(() => ({
  title: { required: helpers.withMessage('Title Is Required', required) },
}))

const validate = useVuelidate(rules, inputs, {$externalResults})

const createCategory = () => {
  validate.value.$clearExternalResults()
  validate.value.$touch()
  if (!validate.value.$error) {
    $externalResults.value = {}
    isLoading.value = true

    CategoriesApi.manageCategories(inputs).then(response => {
      toast.success(response.message)
      router.push({name: 'view-categories'})
    }).catch(error => {
      $externalResults.value = error.response.data.data
      toast.error(error.response.data.message)
    }).finally(() => {
      isLoading.value = false
    })

  }

}

onMounted(() => {
  GlobalApi.getCategoriesList().then(response => {
    categoriesList.value = response.data
  })
})

</script>

<template>
  <VCard>

    <v-card-item>
      <v-card-title>
        Add New Category
      </v-card-title>
    </v-card-item>

    <v-card-text>
      <VForm @submit.prevent="createCategory()">
        <VRow>
          <VCol cols="12" lg='6'>
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

          <VCol cols='12' lg='6'>
            <VSelect
              clearable
              :disabled='isLoading'
              v-model="inputs.parent"
              label="Parent Category"
              :items="categoriesList"
              item-title='title'
              item-value='id'
              variant="outlined"
            ></VSelect>
          </VCol>

          <VCol cols="12">
            <VTextarea
              :disabled='isLoading'
              v-model="inputs.description"
              label="Description"
              type="text"
            />
          </VCol>

          <VCol cols='12'>
            <VBtn
              :loading='isLoading'
              block
              type="submit"
              class='mt-4'

            >
              Create Category
            </VBtn>
          </VCol>



        </VRow>
      </VForm>
    </v-card-text>
  </VCard>
</template>
