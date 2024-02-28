<script setup>
import GalleryApi from '@/controllers/gallery'
import { useToast } from 'vue-toastification'
import Swal from 'sweetalert2/dist/sweetalert2';


const loading = ref(false)
const selectedImages = ref([])
const toast = useToast()
const getImages = (inputs = {}) => {
  loading.value = true
  GalleryApi.getImages(inputs).then(response => {
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
      title: 'Image',
      key: 'image',
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

const deleteImage = (imageId = null) => {
  if (imageId == null && selectedImages.value.length == 0) {
    toast.error('Please Select at least One Image')
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
        item_ids: imageId == null ? selectedImages.value.join(',') : imageId
      }

      GalleryApi.deleteImages(deleteIds).then(response => {
        toast.success(response.message)
        getImages()
      })
    }
  });
}



</script>

<template>
  <VCard>

    <v-card-item>
      <v-card-title>
        Gallery
      </v-card-title>
    </v-card-item>
    <v-card-item>
      <router-link :to="{name: 'create-gallery'}">
        <v-btn variant='flat' class='me-3'>Add New Image</v-btn>
      </router-link>
      <v-btn variant='flat' color='error' icon='ri-delete-bin-line' @click='deleteImage()'></v-btn>
    </v-card-item>
    <v-card-text>
      <v-data-table-server
        v-model='selectedImages'
        item-value='id'
        v-model:items-per-page="tableSettings.itemsPerPage"
        :headers='tableSettings.headers'
        :items-length="tableSettings.totalItems"
        :items="tableSettings.items"
        :loading='loading'
        @update:options="getImages"
        show-select
      >
        <template v-slot:item.image='row'>
          <img width='70' height='70' :src='row.item.image'>
        </template>
        <template v-slot:item.actions="row">
          <v-btn
            color='default'
            variant="plain"
            plain
            icon='ri-delete-bin-line'
            size="small"
            @click='deleteImage(row.item.id)'
          >
          </v-btn>
        </template>
      </v-data-table-server>
    </v-card-text>
  </VCard>
</template>
