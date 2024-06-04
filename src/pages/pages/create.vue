<script setup>
import PagesApi from '@/controllers/pages'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'
import useVuelidate from '@vuelidate/core'
import { helpers, required } from '@vuelidate/validators'
import { useRouter } from 'vue-router'
import { useToast } from 'vue-toastification'

const isLoading = ref(false)
const toast = useToast()
const router = useRouter()
const editorConfig = ref({
  toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
  heading: {
    options: [
      { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
      { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
      { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
    ]
  },
})



const inputs = reactive({
  title: null,
  body: null,
})

const $externalResults = ref({})

const rules = computed(() => ({
  title: { required: helpers.withMessage('Title Is Required', required) },

}))

const validate = useVuelidate(rules, inputs, {$externalResults})

const createPage = () => {
  validate.value.$clearExternalResults()
  validate.value.$touch()
  if (!validate.value.$error) {
    $externalResults.value = {}
    isLoading.value = true

    PagesApi.managePages(inputs).then(response => {
      toast.success(response.message)
      router.push({name: 'view-pages'})
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
        Add New Page
      </v-card-title>
    </v-card-item>

    <v-card-text>
      <VForm @submit.prevent="createPage()">
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
            <ckeditor :editor="ClassicEditor" v-model="inputs.body" :config='editorConfig' :disabled="isLoading"></ckeditor>

          </VCol>

          <VCol cols='12'>
            <VBtn
              :loading='isLoading'
              block
              type="submit"
              class='mt-4'

            >
              Create Page
            </VBtn>
          </VCol>



        </VRow>
      </VForm>
    </v-card-text>
  </VCard>
</template>

<style lang='scss'>
.ck-editor__editable {
  min-height: 500px;
}

</style>
