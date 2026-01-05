<template>
  <v-container fluid>
    <v-card class="card z-index-2 h-100">
      <v-card-text class="card-body p-3">
        <v-data-table-server v-model:items-per-page="itemsPerPage" :headers="headers" :items-length="totalItems"
          :items="invoices" :loading="loading" :search="search" class="elevation-1" item-value="title"
          @update:options="loadInvoices">
          <template v-slot:item="{ item }">
            <tr>
              <td><router-link :to="`/facturen/${item.number}`">{{ item.number }}</router-link></td>
              <td>{{ item.contact?.firstname ?? '' }} {{ item.contact?.affix ?? '' }} {{ item.contact?.lastname ?? '' }}
              </td>
              <td>{{ formatDate(item.created_at) }}</td>
              <td @click="deleteInvoiceWarn(item.id)">Verwijderen</td>
            </tr>
          </template>
        </v-data-table-server>

        <v-dialog v-model="showDeleteWarning" width="auto">
          <v-card>
            <v-card-text>
              Weet je zeker dat je de factuur van ... wilt verwijderen?
            </v-card-text>
            <v-card-actions>
              <v-btn color="red-darken-1" variant="text"
                @click="showDeleteWarning = false; deleteInvoice()">Bevestigen</v-btn>
              <v-btn color="green-darken-1" variant="text" @click="showDeleteWarning = false;">Sluiten</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>



      </v-card-text>
    </v-card>
  </v-container>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from '@/services/axios'
import { DateTime } from 'luxon'

const invoices = ref([])
const search = ref(null)
const totalItems = ref(0)
const showDeleteWarning = ref(false)
const deleteItemId = ref(null)
const loading = ref(true)
const itemsPerPage = ref(20)
const headers = ref([
  {
    title: 'Factuur nr.',
    key: 'invoice_number'
  },
  {
    title: 'Klantnaam',
    key: 'contact.firstname'
  },
  {
    title: 'Aangemaakt op',
    key: 'created_at'
  },
  {
    title: 'Acties',
    key: ''
  }
])

const loadInvoices = async ({ page, itemsPerPage, sortBy }) => {
  loading.value = true
  const response = await axios.get('/api/invoices', { params: { page: page } })
  invoices.value = response.data.data
  totalItems.value = response.data.total
  loading.value = false
}

const deleteInvoiceWarn = async (id) => {
  deleteItemId.value = id
  if (showDeleteWarning.value == false) {
    showDeleteWarning.value = true
  }

}

const deleteInvoice = async () => {
  const response = await axios.delete('/api/invoices/' + deleteItemId.value)

  if (response.data.status == 'deleted') {
    console.log(deleteItemId.value)
    const filteredInvoices = invoices.value.filter(obj => obj.id !== deleteItemId.value);
    console.log(filteredInvoices)
    invoices.value = filteredInvoices
  }

  deleteItemId.value = null

}

loadInvoices({ page: 1, itemsPerPage: 20, sortBy: false })

const formatDate = (date) => {
  return DateTime.fromISO(date).toFormat("dd-LL-yyyy 'om' HH:mm:ss")
}
</script>