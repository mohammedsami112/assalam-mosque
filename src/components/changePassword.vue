<script setup>
  import AuthApi from '@/controllers/auth'
  import { helpers, required, sameAs } from '@vuelidate/validators'
  import useVuelidate from '@vuelidate/core'
  import { useToast } from 'vue-toastification'

  const dialog = ref(false)
  const isLoading = ref(false)
  const toast = useToast()

  const inputs = reactive({
    current_password: null,
    new_password: null,
    new_password_confirmation: null,
  })

  const $externalResults = ref({})

  const rules = computed(() => ({
    current_password: { required: helpers.withMessage('Current Password Is Required', required) },
    new_password: { required: helpers.withMessage('New Password Is Required', required) },
    new_password_confirmation: {
      required: helpers.withMessage('Password Confirmation Is Required', required),
      sameAs: helpers.withMessage("Password Isn't Match", sameAs(inputs.new_password))
    },
  }))

  const validate = useVuelidate(rules, inputs, {$externalResults})

  const changePassword = () => {
    validate.value.$clearExternalResults()
    validate.value.$touch()
    if (!validate.value.$error) {
      $externalResults.value = {}
      isLoading.value = true

      AuthApi.changePassword(inputs).then(response => {
        toast.success(response.message)
      }).catch(error => {
        $externalResults.value = error.response.data.data
        toast.error(error.response.data.message)
      }).finally(() => {
        isLoading.value = false
        dialog.value = false
      })

    }

  }

</script>

<template>
  <v-dialog v-model="dialog" max-width="600">
    <template v-slot:activator="{ props: activatorProps }">
      <VListItem  v-bind="activatorProps">
        <template #prepend>
          <VIcon
            class="me-2"
            icon="ri-lock-line"
            size="22"
          />
        </template>

        <VListItemTitle>Change Password</VListItemTitle>
      </VListItem>
    </template>
    <v-card
      title="Change Password"
    >
      <v-form @submit.prevent='changePassword()'>
        <v-card-text>
          <v-row dense>
            <v-col cols="12">
              <VTextField
                :disabled='isLoading'
                :error-messages='validate.current_password.$errors.map(e => e.$message)'
                @input="validate.current_password.$touch"
                @blur="validate.current_password.$touch"
                v-model="inputs.current_password"
                label="Current Password"
                type="password"
                required
              />
            </v-col>
            <v-col cols="12">
              <VTextField
                :disabled='isLoading'
                :error-messages='validate.new_password.$errors.map(e => e.$message)'
                @input="validate.new_password.$touch"
                @blur="validate.new_password.$touch"
                v-model="inputs.new_password"
                label="New Password"
                type="password"
                required
              />
            </v-col>
            <v-col cols="12">
              <VTextField
                :disabled='isLoading'
                :error-messages='validate.new_password_confirmation.$errors.map(e => e.$message)'
                @input="validate.new_password_confirmation.$touch"
                @blur="validate.new_password_confirmation.$touch"
                v-model="inputs.new_password_confirmation"
                label="Confirm Password"
                type="password"
                required
              />
            </v-col>

          </v-row>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn
            text="Close"
            variant="plain"
            type='button'
            @click="dialog = false"
          ></v-btn>

          <v-btn
            color="primary"
            text="Save"
            variant="tonal"
            type='submit'
          ></v-btn>
        </v-card-actions>
      </v-form>
    </v-card>
  </v-dialog>
</template>

