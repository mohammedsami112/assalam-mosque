<script setup>
import avatar1 from '@images/avatars/avatar-1.png'
import ChangePassword from '@/components/changePassword.vue'
import { useRouter } from 'vue-router'
import { useToast } from 'vue-toastification'
import Auth from '@/controllers/auth'
import { useUserStore } from '@/stores/user'

const toast = useToast()
const router = useRouter()
const userStore = useUserStore()

const logout = () => {
  Auth.logout().then(response => {
    userStore.logoutSuccess()
    toast.success(response.message)
    router.push({name: 'login'})
  })
}

</script>

<template>
  <VBadge
    dot
    location="bottom right"
    offset-x="3"
    offset-y="3"
    color="success"
    bordered
  >
    <VAvatar
      class="cursor-pointer"
      color="primary"
      variant="tonal"
    >
      <VImg :src="avatar1" />

      <!-- SECTION Menu -->
      <VMenu
        activator="parent"
        width="230"
        location="bottom end"
        offset="14px"
      >
        <VList>
          <!-- 👉 User Avatar & Name -->
          <VListItem>
            <template #prepend>
              <VListItemAction start>
                <VBadge
                  dot
                  location="bottom right"
                  offset-x="3"
                  offset-y="3"
                  color="success"
                >
                  <VAvatar
                    color="primary"
                    variant="tonal"
                  >
                    <VImg :src="avatar1" />
                  </VAvatar>
                </VBadge>
              </VListItemAction>
            </template>

            <VListItemTitle class="font-weight-semibold">
              {{ userStore.userData.username }}
            </VListItemTitle>
          </VListItem>
          <ChangePassword></ChangePassword>
          <VDivider class="my-2" />



          <!-- 👉 Logout -->
          <VListItem @click='logout()'>
            <template #prepend>
              <VIcon
                class="me-2"
                icon="ri-logout-box-r-line"
                size="22"
              />
            </template>

            <VListItemTitle>Logout</VListItemTitle>
          </VListItem>
        </VList>
      </VMenu>
      <!-- !SECTION -->
    </VAvatar>
  </VBadge>
</template>
