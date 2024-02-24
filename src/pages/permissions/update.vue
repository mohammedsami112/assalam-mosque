<script setup>
import PermissionsApi from '@/controllers/permissions'
import { useToast } from 'vue-toastification'
import { useRouter } from 'vue-router'
import { required, helpers, sameAs } from '@vuelidate/validators'
import useVuelidate from '@vuelidate/core'
import { usePermissionsStore } from '@/stores/permissions'


const permissionsStore = usePermissionsStore()
const fetchPermissionLoading = ref(true)
const isLoading = ref(false)
const toast = useToast()
const router = useRouter()

const permission = ref({})

const getPermission = () => {
  PermissionsApi.getPermission(router.currentRoute.value.params.id).then(response => {
    permission.value = response.data
    inputs.item_id = permission.value.id
    inputs.title = permission.value.title
    inputs.privilege = permission.value.privilege == '*' ? permissionsStore.roles : permission.value.privilege.split(',')
  }).finally(() => {
    fetchPermissionLoading.value = false
  })
}

const inputs = reactive({
  item_id: null,
  title: null,
  privilege: [],
})

const $externalResults = ref({})

const rules = computed(() => ({
  title: { required: helpers.withMessage('Title Is Required', required) },
}))

const validate = useVuelidate(rules, inputs, {$externalResults})

const updatePermission = () => {
  validate.value.$clearExternalResults()
  validate.value.$touch()
  if (!validate.value.$error) {
    $externalResults.value = {}
    isLoading.value = true

    PermissionsApi.managePermissions(inputs).then(response => {
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



onMounted(() => {
  if (!router.currentRoute.value.params.id) {
    router.push({name: 'view-permissions'})
  }
  getPermission()
})

</script>

<template>
  <VCard :loading='fetchPermissionLoading'>

    <v-card-item>
      <v-card-title>
        Edit Permission : {{ permission.title }}
      </v-card-title>
    </v-card-item>

    <v-card-text>
      <VForm @submit.prevent="updatePermission()">
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
              Update Permission
            </VBtn>
          </VCol>



        </VRow>
      </VForm>
    </v-card-text>
  </VCard>
</template>
