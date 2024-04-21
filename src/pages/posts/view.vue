<script setup>
import PostsApi from '@/controllers/posts'
import { useToast } from 'vue-toastification'
import Swal from 'sweetalert2/dist/sweetalert2';


const search = ref()
const title = ref()
const loading = ref(false)
const selectedPosts = ref([])
const toast = useToast()

watch(() => title, (value) => {
  search.value = value
}, {deep: true})
const getPosts = (inputs = {}) => {
  loading.value = true
  PostsApi.getPosts(inputs).then(response => {
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
      title: 'Category',
      key: 'post_category.title',
      sortable: false,
      align: 'center'
    },
    {
      title: 'Author',
      key: 'post_author.name',
      sortable: false,
      align: 'center'
    },
    {
      title: 'Status',
      key: 'status',
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

const deletePosts = (postId = null) => {
  if (postId == null && selectedPosts.value.length == 0) {
    toast.error('Please Select at least One Post')
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
        item_ids: postId == null ? selectedPosts.value.join(',') : postId
      }

      PostsApi.deletePosts(deleteIds).then(response => {
        toast.success(response.message)
        getPosts()
      })
    }
  });
}



</script>

<template>
  <VCard>

    <v-card-item>
      <v-card-title>
        Posts
      </v-card-title>
    </v-card-item>
    <v-card-item>
        <router-link :to="{name: 'create-posts'}">
          <v-btn variant='flat' class='me-3'>Add New Posts</v-btn>
        </router-link>
        <v-btn variant='flat' color='error' icon='ri-delete-bin-line' @click='deletePosts()'></v-btn>
        <v-text-field v-model="search" class="ma-2" density="compact" placeholder="Search title..." hide-details></v-text-field>
    </v-card-item>
    <v-card-text>
      <v-data-table-server
        v-model='selectedPosts'
        item-value='id'
        v-model:items-per-page="tableSettings.itemsPerPage"
        :headers='tableSettings.headers'
        :items-length="tableSettings.totalItems"
        :items="tableSettings.items"
        :loading='loading'
        :search='search'
        @update:options="getPosts"
        show-select
      >
        <template v-slot:item.status='row'>
          {{ row.item.status == 1 ? 'Published' : 'Draft' }}
        </template>
        <template v-slot:item.actions="row">
          <router-link :to="{name: 'update-posts', params: {id: row.item.id}}">
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
            @click='deletePosts(row.item.id)'
          >
          </v-btn>
        </template>
      </v-data-table-server>
    </v-card-text>
  </VCard>
</template>
