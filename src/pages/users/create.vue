<script setup>
import UsersApi from '@/controllers/users'
import GlobalApi from '@/controllers/global'
import { useToast } from 'vue-toastification'
import { useRouter } from 'vue-router'
import { required, helpers, sameAs } from '@vuelidate/validators'
import useVuelidate from '@vuelidate/core'


const isPasswordVisible = ref(false)
const isPasswordConfirmationVisible = ref(false)
const isLoading = ref(false)
const toast = useToast()
const router = useRouter()

const rolesList = ref([]);
const inputs = reactive({
  name: null,
  username: null,
  password: null,
  password_confirmation: null,
  role: null,
})

const $externalResults = ref({})

const rules = computed(() => ({
  name: { required: helpers.withMessage('Name Is Required', required) },
  username: { required: helpers.withMessage('Username Is Required', required) },
  password: { required: helpers.withMessage('Password Is Required', required) },
  password_confirmation: {
    required: helpers.withMessage('Password Confirmation Is Required', required),
    sameAs: helpers.withMessage("Password Isn't Match", sameAs(inputs.password))
  },
  role: { required: helpers.withMessage('Role Is Required', required) }
}))

const validate = useVuelidate(rules, inputs, {$externalResults})

const createUser = () => {
  validate.value.$clearExternalResults()
  validate.value.$touch()
  if (!validate.value.$error) {
    $externalResults.value = {}
    isLoading.value = true

    UsersApi.manageUsers(inputs).then(response => {
      toast.success(response.message)
      router.push({name: 'view-users'})
    }).catch(error => {
      $externalResults.value = error.response.data.data
      toast.error(error.response.data.message)
    }).finally(() => {
      isLoading.value = false
    })

  }

}



onMounted(() => {
  GlobalApi.getPermissionsList().then(response => {
    rolesList.value = response.data
  })
})

</script>

<template>
  <VCard>

    <v-card-item>
      <v-card-title>
        Add New User
      </v-card-title>
    </v-card-item>

    <v-card-text>
      <VForm @submit.prevent="createUser()">
        <VRow>
          <VCol cols="12" lg='6'>
            <VTextField
              :disabled='isLoading'
              :error-messages='validate.name.$errors.map(e => e.$message)'
              @input="validate.name.$touch"
              @blur="validate.name.$touch"
              v-model="inputs.name"
              label="Name"
              type="text"
              required

            />
          </VCol>
          <VCol cols="12" lg='6'>
            <VTextField
              :disabled='isLoading'
              :error-messages='validate.username.$errors.map(e => e.$message)'
              @input="validate.username.$touch"
              @blur="validate.username.$touch"
              v-model="inputs.username"
              label="Username"
              type="text"
              required

            />
          </VCol>

          <VCol cols="12">
            <VTextField
              :disabled='isLoading'
              :error-messages='validate.password.$errors.map(e => e.$message)'
              @input="validate.password.$touch"
              @blur="validate.password.$touch"
              required
              v-model="inputs.password"
              label="Password"
              placeholder="············"
              :type="isPasswordVisible ? 'text' : 'password'"
              :append-inner-icon="isPasswordVisible ? 'ri-eye-off-line' : 'ri-eye-line'"
              @click:append-inner="isPasswordVisible = !isPasswordVisible"
            />
          </VCol>
          <VCol cols="12">
            <VTextField
              :disabled='isLoading'
              :error-messages='validate.password_confirmation.$errors.map(e => e.$message)'
              @input="validate.password_confirmation.$touch"
              @blur="validate.password_confirmation.$touch"
              required
              v-model="inputs.password_confirmation"
              label="Password Confirmation"
              placeholder="············"
              :type="isPasswordConfirmationVisible ? 'text' : 'password'"
              :append-inner-icon="isPasswordConfirmationVisible ? 'ri-eye-off-line' : 'ri-eye-line'"
              @click:append-inner="isPasswordConfirmationVisible = !isPasswordConfirmationVisible"
            />
          </VCol>
          <VCol cols='12'>
            <VSelect
              clearable
              :disabled='isLoading'
              :error-messages='validate.role.$errors.map(e => e.$message)'
              @input="validate.role.$touch"
              @blur="validate.role.$touch"
              required
              v-model="inputs.role"
              label="User Role"
              :items="rolesList"
              item-title='title'
              item-value='id'
              variant="outlined"
            ></VSelect>
          </VCol>
          <VCol cols='12'>
            <VBtn
              :loading='isLoading'
              block
              type="submit"
              class='mt-4'

            >
              Create User
            </VBtn>
          </VCol>


        </VRow>
      </VForm>
    </v-card-text>
  </VCard>
</template>
