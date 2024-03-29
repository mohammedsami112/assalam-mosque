<script setup>
import PostsApi from '@/controllers/posts'
import { useToast } from 'vue-toastification'
import { useRouter } from 'vue-router'
import { required, helpers, minLength } from '@vuelidate/validators'
import useVuelidate from '@vuelidate/core'
import GlobalApi from '@/controllers/global'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

const categoriesList = ref([]);
const statusesList = ref([
  {
    title: 'Publish',
    value: 1
  },
  {
    title: 'Draft',
    value: 0
  },
])
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

const handelThumbnail = (event) => {
  inputs.thumbnail = event.target.files[0]
}

const inputs = reactive({
  title: null,
  body: null,
  thumbnail: null,
  status: null,
  category: null,
})

const $externalResults = ref({})

const rules = computed(() => ({
  title: { required: helpers.withMessage('Title Is Required', required) },
  status: { required: helpers.withMessage('Status Is Required', required) },
  category: { required: helpers.withMessage('Category Is Required', required) },
}))

const validate = useVuelidate(rules, inputs, {$externalResults})

const createPost = () => {
  validate.value.$clearExternalResults()
  validate.value.$touch()
  if (!validate.value.$error) {
    $externalResults.value = {}
    isLoading.value = true

    PostsApi.managePosts(inputs).then(response => {
      toast.success(response.message)
      router.push({name: 'view-posts'})
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
        Add New Post
      </v-card-title>
    </v-card-item>

    <v-card-text>
      <VForm @submit.prevent="createPost()">
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
              :error-messages='validate.category.$errors.map(e => e.$message)'
              @input="validate.category.$touch"
              @blur="validate.category.$touch"
              :disabled='isLoading'
              v-model="inputs.category"
              label="Category"
              :items="categoriesList"
              item-title='title'
              item-value='id'
              variant="outlined"
            ></VSelect>
          </VCol>

          <VCol cols='12' lg='6'>
            <VSelect
              clearable
              :error-messages='validate.status.$errors.map(e => e.$message)'
              @input="validate.status.$touch"
              @blur="validate.status.$touch"
              :disabled='isLoading'
              v-model="inputs.status"
              label="Status"
              :items="statusesList"
              item-title='title'
              item-value='value'
              variant="outlined"
            ></VSelect>
          </VCol>

          <VCol cols='12' lg='6'>
            <VFileInput
              clearable
              :disabled='isLoading'
              accept="image/*"
              label="Thumbnail"
              variant="outlined"
              @change = "handelThumbnail"
            ></VFileInput>
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
              Create Post
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
