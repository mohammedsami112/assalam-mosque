<script setup>
import PagesApi from '@/controllers/pages';
import Swal from 'sweetalert2/dist/sweetalert2';
import { useToast } from 'vue-toastification';


const loading = ref(false)
const selectedPages = ref([])
const toast = useToast()
const getPages = (inputs = {}) => {
  loading.value = true
  PagesApi.getPages(inputs).then(response => {
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
      title: 'Title',
      key: 'title',
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

const deletePages = (pageId = null) => {
  if (pageId == null && selectedPages.value.length == 0) {
    toast.error('Please Select at least One Page')
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
        item_ids: pageId == null ? selectedPages.value.join(',') : pageId
      }

      PagesApi.deletePages(deleteIds).then(response => {
        toast.success(response.message)
        getPages()
      })
    }
  });
}



</script>

<template>
  <VCard>

    <v-card-item>
      <v-card-title>
        Pages
      </v-card-title>
    </v-card-item>
    <v-card-item>
      <router-link :to="{name: 'create-pages'}">
        <v-btn variant='flat' class='me-3'>Add New Pages</v-btn>
      </router-link>
      <v-btn variant='flat' color='error' icon='ri-delete-bin-line' @click='deletePosts()'></v-btn>
    </v-card-item>
    <v-card-text>
      <v-data-table-server
        v-model='selectedPages'
        item-value='id'
        v-model:items-per-page="tableSettings.itemsPerPage"
        :headers='tableSettings.headers'
        :items-length="tableSettings.totalItems"
        :items="tableSettings.items"
        :loading='loading'
        @update:options="getPages"
        show-select
      >

        <template v-slot:item.actions="row">
          <router-link :to="{name: 'update-pages', params: {id: row.item.id}}">
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
            @click='deletePages(row.item.id)'
          >
          </v-btn>
        </template>
      </v-data-table-server>
    </v-card-text>
  </VCard>
</template>
