<template>
  <v-container fluid>
    <v-card class="card z-index-2 h-100">
      <v-card-text class="card-body p-3">
      <v-data-table-virtual :headers="headers" :items="invoices" item-value="name">
        <template #item.order_id="{ item }" style="text-align: right">
          <RouterLink :to="`/factuuraanvragen/${item.order_id}`">{{ item.order_id }}</RouterLink>
        </template>
        <template #item.fullname="{ item }">
          {{ item.billing_details.firstName }} {{ item.billing_details.surname }}
        </template>
        <template #item.products="{ item }" style="text-align: right">
          {{ totalAmount(item.products) }}
        </template>
        <template #item.status="{ item }" style="text-align: right">
          <v-chip :class="getStatusStyle(item.status)" class="px-10">
            {{ item.status }}
          </v-chip>
        </template>
      </v-data-table-virtual>
      </v-card-text>
    </v-card>
  </v-container>
</template>


<script setup>

import { ref, onMounted } from 'vue'
import axios from 'axios'

const headers = ref([
  { title: 'Ordernummer', align: 'start', key: 'order_id' },
  { title: 'Factuurmummer ', align: 'start', key: 'invoice_number' },
  {
    title: 'Naam', align: 'start', key: 'fullname', sortRaw(a, b) {
      const nameA = `${a.billing_details.firstName} ${a.billing_details.surname}`.toLowerCase()
      const nameB = `${b.billing_details.firstName} ${b.billing_details.surname}`.toLowerCase()
      return nameA.localeCompare(nameB)
    }
  },
  {
    title: 'Totaalbedrag', align: 'start', key: 'products', width: '10%',
    sortRaw(a, b) {
      const totalA = a.products.reduce((total, product) => {
        const price = product.quantity * product.unitPrice;
        return total + price;
      }, 0);

      const totalB = b.products.reduce((total, product) => {
        const price = product.quantity * product.unitPrice;
        return total + price;
      }, 0);

      return totalA - totalB;

    }
  },
  { title: 'Land', align: 'start', key: 'country' },
  { title: 'Aanvraagdatum', align: 'start', key: 'request_date' },
  { title: 'Besteldatum', align: 'start', key: 'order_date' },
  { title: 'Status', align: 'start', key: 'status' },

])

const invoices = ref([])
const total = ref()

onMounted(async () => {
  getInvoices()
})

const getInvoices = async () => {
  const response = await axios.get('/api/invoice_requests')
  total.value = response.data.length
  invoices.value = response.data
}

const totalAmount = (products) => {

  const formatter = new Intl.NumberFormat('nl-NL', {
    style: 'currency',
    currency: 'EUR',
  })


  return formatter.format(products.reduce((total, product) => {
    const price = product.quantity * product.unitPrice
    return total + price
  }, 0));
}

const getStatusStyle = (status) => {
  switch (status) {
    case 'Open':
      return 'chip-open';
    case 'Gesloten':
      return 'chip-closed';
    case 'In Behandeling':
      return 'chip-in-progress';
    case 'Afgewezen':
      return 'chip-rejected';
    default:
      return 'chip-default'; // Default style for other statuses
  }
}

</script>

<style scoped>
.chip-open {
  background-color: rgba(43, 205, 252, .7);
  font-size: 1em;
  color: #000000;
}

.chip-closed {
  background-color: rgba(53, 184, 88, .7);
  font-size: 1em;
  color: white;
}

.chip-in-progress {
  background-color: orange;
  color: white;
}

.chip-rejected {
  background-color: red;
  color: white;
}

.chip-default {
  background-color: grey;
  color: white;
}
</style>