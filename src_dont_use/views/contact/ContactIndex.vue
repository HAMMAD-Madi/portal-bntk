<template>
  <v-container fluid>
    <v-card class="card z-index-2 h-100">
      <v-card-text class="card-body p-3">
        <v-data-table-server v-model:items-per-page="itemsPerPage" :headers="headers" :items-length="totalItems"
          :items="contacts" :loading="loading" :search="search" class="elevation-1" @update:options="loadContacts">
          <template v-slot:item="{ item }">
            <tr>
              <td><router-link :to="`/contact/${item.firstname}`">{{ item.firstname }} {{ item.affix }} {{ item.lastname
                  }}</router-link></td>
              <td>{{ formatDate(item.created_at) }}</td>
              <td class="deleted" style="color:red" @click="deleteContact(item.id)">Delete</td>
            </tr>
          </template>
        </v-data-table-server>

      </v-card-text>
    </v-card>
  </v-container>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from '@/services/axios'
import { DateTime } from 'luxon'
const contacts = ref([])
const search = ref(null)
const totalItems = ref(0)
const loading = ref(true)
const itemsPerPage = ref(20)
const headers = ref([
  {
    title: 'Klantnaam',
    key: 'firstname'
  },
  {
    title: 'Gemaakt op',
    key: 'created_at'
  },
  {
    title: 'Acties',
    key: ''
  }
])

const formatDate = (date) => {
  return DateTime.fromISO(date).toFormat("dd-LL-yyyy 'om' HH:mm:ss")
}

const loadContacts = async ({ page, itemsPerPage, sortBy }) => {
  loading.value = true
  const response = await axios.get('/api/contacts', { params: { page: page } })
  contacts.value = response.data
  totalItems.value = response.data.total
  loading.value = false
}

loadContacts({ page: 1, itemsPerPage: 20, sortBy: false })

const deleteContact = async (id) => {
  const response = await axios.delete('/api/contacts/' + id)
}
</script>

<style>
.deleted:hover {
  cursor: pointer;
  text-decoration: underline;
}
</style>