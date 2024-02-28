<script setup>
import DonationsApi from '@/controllers/donations'
import { useToast } from 'vue-toastification'
import Swal from 'sweetalert2/dist/sweetalert2';


const loading = ref(false)
const toast = useToast()
const getDonations = (inputs = {}) => {
  loading.value = true
  DonationsApi.getDonations(inputs).then(response => {
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
      title: 'Amount',
      key: 'amount',
      sortable: false,
      align: 'center'
    },
    {
      title: 'Email',
      key: 'email',
      sortable: false,
      align: 'center'
    },
    {
      title: 'Method',
      key: 'method',
      sortable: false,
      align: 'center'
    },
    {
      title: 'type',
      key: 'donation_type.title',
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
  ],
  totalItems: 0,
  itemsPerPage: 10,
  items: [],
})

</script>

<template>
  <VCard>

    <v-card-item>
      <v-card-title>
        Donations
      </v-card-title>
    </v-card-item>
    <v-card-text>
      <v-data-table-server
        item-value='id'
        v-model:items-per-page="tableSettings.itemsPerPage"
        :headers='tableSettings.headers'
        :items-length="tableSettings.totalItems"
        :items="tableSettings.items"
        :loading='loading'
        @update:options="getDonations"
      >
      </v-data-table-server>
    </v-card-text>
  </VCard>
</template>
