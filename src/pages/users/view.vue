<script setup>
import UsersApi from '@/controllers/users'
import { useToast } from 'vue-toastification'
import Swal from 'sweetalert2/dist/sweetalert2';

const loading = ref(false)
const selectedUsers = ref([])
const toast = useToast()
const getUsers = (inputs = {}) => {
  loading.value = true
  UsersApi.getUsers(inputs).then(response => {
    tableSettings.itemsPerPage = response.data.per_page
    tableSettings.totalItems = response.data.total
    tableSettings.items = response.data.data
  }).finally(() => {
    loading.value = false
  })
}

const tableSettings = reactive({
  headers: [
    {
      title: '#',
      key: 'id',
      sortable: false,
      align: 'center'
    },
    {
      title: 'Name',
      key: 'name',
      sortable: false,
      align: 'center'
    },
    {
      title: 'Username',
      key: 'username',
      sortable: false,
      align: 'center'
    },
    {
      title: 'Role',
      key: 'permission.title',
      sortable: false,
      align: 'center'
    },
    {
      title: 'Created At',
      key: 'created_at',
      sortable: false,
      align: 'center'
    },
    {
      title: 'Updated At',
      key: 'updated_at',
      sortable: false,
      align: 'center'
    },
    {
      title: 'actions',
      key: 'actions',
      sortable: false,
      align: 'center'
    },
  ],
  totalItems: 0,
  itemsPerPage: 10,
  items: [],
})

const deleteUser = (userId = null) => {
  if (userId == null && selectedUsers.value.length == 0) {
    toast.error('Please Select at least One User')
    return true;
  }
  Swal.fire({
    title: "Are you sure?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
  }).then((result) => {
    if (result.isConfirmed) {
      loading.value = true

      let deleteIds = {
        item_ids: userId == null ? selectedUsers.value.join(',') : userId
      }

      UsersApi.deleteUsers(deleteIds).then(response => {
        toast.success(response.message)
        getUsers()
      })
    }
  });
}



</script>

<template>
  <VCard>

    <v-card-item>
      <v-card-title>
        Users
      </v-card-title>
    </v-card-item>
    <v-card-item>
      <router-link :to="{name: 'create-users'}">
        <v-btn variant='flat' class='me-3'>Add New User</v-btn>
      </router-link>
      <v-btn variant='flat' color='error' icon='ri-delete-bin-line' @click='deleteUser()'></v-btn>
    </v-card-item>
    <v-card-text>
      <v-data-table-server
        v-model='selectedUsers'
        item-value='id'
        v-model:items-per-page="tableSettings.itemsPerPage"
        :headers='tableSettings.headers'
        :items-length="tableSettings.totalItems"
        :items="tableSettings.items"
        :loading='loading'
        @update:options="getUsers"
        show-select
      >
        <template v-slot:item.actions="row">
          <router-link :to="{name: 'update-users', params: {id: row.item.id}}">
            <v-btn
              color='default'
              variant="plain"
              icon='ri-pencil-line'
              size="small"
              class="me-3"
            ></v-btn>
          </router-link>
          <v-btn
            color='default'
            variant="plain"
            plain
            icon='ri-delete-bin-line'
            size="small"
            @click='deleteUser(row.item.id)'
          >
          </v-btn>
        </template>
      </v-data-table-server>
    </v-card-text>
  </VCard>
</template>
