<script setup>
import { useTheme } from 'vuetify'
import { useToast } from 'vue-toastification'
import { useRouter } from 'vue-router'
import { useUserStore } from '@/stores/user'
import Auth from '@/controllers/auth'
import authV1MaskDark from '@images/pages/auth-v1-mask-dark.png'
import authV1MaskLight from '@images/pages/auth-v1-mask-light.png'

import { required, helpers } from '@vuelidate/validators'
import useVuelidate from '@vuelidate/core'

const userStore = useUserStore()
const toast = useToast()
const router = useRouter()
const isPasswordVisible = ref(false)
const isLoading = ref(false)

const inputs = reactive({
  username: null,
  password: null,
})

const $externalResults = ref({})

const rules = computed(() => ({
  username: { required: helpers.withMessage('Username Is Required', required) },
  password: { required: helpers.withMessage('Password Is Required', required) }
}))

const validate = useVuelidate(rules, inputs, {$externalResults})

const login = () => {
  validate.value.$clearExternalResults()
  validate.value.$touch()

  if (!validate.value.$error) {
    $externalResults.value = {}
    isLoading.value = true
    Auth.login(inputs).then(response => {
      userStore.loginSuccess(response.data)
      toast.success(response.message)
      router.push({name: 'dashboard'})
    }).catch(error => {
      $externalResults.value = error.response.data.data
      toast.error(error.response.data.message)
    }).finally(() => {
      isLoading.value = false
    })

  }

}


// Theme
const vuetifyTheme = useTheme()
const authThemeMask = computed(() => {
  return vuetifyTheme.global.name.value === 'light' ? authV1MaskLight : authV1MaskDark
})

</script>

<template>
  <!-- eslint-disable vue/no-v-html -->

  <div class="auth-wrapper d-flex align-center justify-center pa-4">
    <VCard
      class="auth-card pa-4 pt-7"
      width="448"
    >
      <VCardItem class="justify-center">


        <VCardTitle class="font-weight-semibold text-2xl text-uppercase">
          Assalam Mosque
        </VCardTitle>
      </VCardItem>

      <VCardText>
        <VForm @submit.prevent="login()">
          <VRow>
            <VCol cols="12">
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


              <!-- login button -->
              <VBtn
                :loading='isLoading'
                block
                type="submit"
                class='mt-4'

              >
                Login
              </VBtn>
            </VCol>


          </VRow>
        </VForm>
      </VCardText>
    </VCard>

    <!-- bg img -->
    <VImg
      class="auth-footer-mask d-none d-md-block"
      :src="authThemeMask"
    />
  </div>
</template>

<style lang="scss">
@use "@core/scss/pages/page-auth.scss";
</style>
