<script setup>
import CategoriesApi from '@/controllers/categories'
import { useToast } from 'vue-toastification'
import Swal from 'sweetalert2/dist/sweetalert2';


const loading = ref(false)
const selectedCategories = ref([])
const toast = useToast()
const getCategories = (inputs = {}) => {
  loading.value = true
  CategoriesApi.getCategories(inputs).then(response => {
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
      title: 'Description',
      key: 'description',
      sortable: false,
      align: 'center'
    },
    {
      title: 'Parent',
      key: 'parent_category.title',
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

const deleteCategories = (categoryId = null) => {
  if (categoryId == null && selectedCategories.value.length == 0) {
    toast.error('Please Select at least One Category')
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
        item_ids: categoryId == null ? selectedCategories.value.join(',') : categoryId
      }

      CategoriesApi.deleteCategories(deleteIds).then(response => {
        toast.success(response.message)
        getCategories()
      })
    }
  });
}



</script>

<template>
  <VCard>

    <v-card-item>
      <v-card-title>
        Categories
      </v-card-title>
    </v-card-item>
    <v-card-item>
      <router-link :to="{name: 'create-categories'}">
        <v-btn variant='flat' class='me-3'>Add New Category</v-btn>
      </router-link>
      <v-btn variant='flat' color='error' icon='ri-delete-bin-line' @click='deleteCategories()'></v-btn>
    </v-card-item>
    <v-card-text>
      <v-data-table-server
        v-model='selectedCategories'
        item-value='id'
        v-model:items-per-page="tableSettings.itemsPerPage"
        :headers='tableSettings.headers'
        :items-length="tableSettings.totalItems"
        :items="tableSettings.items"
        :loading='loading'
        @update:options="getCategories"
        show-select
      >
        <template v-slot:item.actions="row">
          <router-link :to="{name: 'update-categories', params: {id: row.item.id}}">
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
            @click='deleteCategories(row.item.id)'
          >
          </v-btn>
        </template>
      </v-data-table-server>
    </v-card-text>
  </VCard>
</template>
