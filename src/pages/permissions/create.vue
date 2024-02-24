<script setup>
import PermissionsApi from '@/controllers/permissions'
import { usePermissionsStore } from '@/stores/permissions'
import { useToast } from 'vue-toastification'
import { useRouter } from 'vue-router'
import { required, helpers, minLength } from '@vuelidate/validators'
import useVuelidate from '@vuelidate/core'


const isLoading = ref(false)
const permissionsStore = usePermissionsStore()
const toast = useToast()
const router = useRouter()

const inputs = reactive({
  title: null,
  privilege: [],
})

const $externalResults = ref({})

const rules = computed(() => ({
  title: { required: helpers.withMessage('Title Is Required', required) },
}))

const validate = useVuelidate(rules, inputs, {$externalResults})

const createPermission = () => {
  validate.value.$clearExternalResults()
  validate.value.$touch()
  if (!validate.value.$error) {
    $externalResults.value = {}
    isLoading.value = true

    PermissionsApi.managePermissions(inputs).then(response => {
      console.log(response)
      toast.success(response.message)
      router.push({name: 'view-permissions'})
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
        Add New Permissions
      </v-card-title>
    </v-card-item>

    <v-card-text>
      <VForm @submit.prevent="createPermission()">
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

          <VCol cols='12' lg='6' md='6' v-for='permission in permissionsStore.roles'>
            <v-checkbox
              v-model="inputs.privilege"
              :label="permission"
              :value="permission"
            ></v-checkbox>
          </VCol>

          <VCol cols='12'>
            <VBtn
              :loading='isLoading'
              block
              type="submit"
              class='mt-4'

            >
              Create Permission
            </VBtn>
          </VCol>



        </VRow>
      </VForm>
    </v-card-text>
  </VCard>
</template>
