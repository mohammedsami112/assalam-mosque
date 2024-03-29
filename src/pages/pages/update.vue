<script setup>
import PagesApi from '@/controllers/pages'
import { useToast } from 'vue-toastification'
import { useRouter } from 'vue-router'
import { required, helpers, sameAs } from '@vuelidate/validators'
import useVuelidate from '@vuelidate/core'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'

const fetchPageLoading = ref(true)
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

const page = ref({})

const getPage = () => {
  PagesApi.getPage(router.currentRoute.value.params.id).then(response => {
    page.value = response.data
    inputs.item_id = page.value.id
    inputs.title = page.value.title
    inputs.body = page.value.content
  }).finally(() => {
    fetchPageLoading.value = false
  })
}

const inputs = reactive({
  item_id: null,
  title: null,
  body: null,
})

const $externalResults = ref({})

const rules = computed(() => ({
  title: { required: helpers.withMessage('Title Is Required', required) },
  body: { required: helpers.withMessage('Content Is Required', required) },
}))

const validate = useVuelidate(rules, inputs, {$externalResults})

const updatePage = () => {
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



onMounted(() => {
  if (!router.currentRoute.value.params.id) {
    router.push({name: 'view-pages'})
  }
  getPage()
})

</script>

<template>
  <VCard :loading='fetchPageLoading'>

    <v-card-item>
      <v-card-title>
        Edit Page : {{ page.title }}
      </v-card-title>
    </v-card-item>

    <v-card-text>
      <VForm @submit.prevent="updatePage()">
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
              Update Page
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
