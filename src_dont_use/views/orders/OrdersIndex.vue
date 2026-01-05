<template>
    <v-container fluid>
        <v-card class="card z-index-2 h-100">
            <v-card-text class="card-body p-3">

                <v-text-field v-model="search" variant="outlined" label="Zoeken"></v-text-field>
                <v-data-table-server v-model:items-per-page="itemsPerPage" :headers="headers" :items="orders"
                    :items-length="totalItems" :loading="loading" :search="search" item-value="order_id"
                    @update:options="loadItems">
                    <template #item.order_id="{ item }">
                        <RouterLink :to="`/orders/${item.order_id}`">{{ item.order_id }}</RouterLink>
                    </template>
                    <template #item.fullname="{ item }">
                        {{ item.contact.billing_firstname }} {{ item.contact.billing_lastname }}
                    </template>
                    <template v-slot:item.delivery_codes="{ item }">
                        {{ getDeliveries(item.delivery_codes) }}
                    </template>
                    <template v-slot:item.order_date="{ item }">
                        {{ formatDate(item.order_date) }}
                    </template>
                    <template v-slot:item.latest_handover_datetime="{ item }">
                        {{ formatDate(item.latest_handover_datetime) }}
                    </template>


                </v-data-table-server>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<script setup>

import { ref } from 'vue'
import axios from 'axios'
import { DateTime } from 'luxon'

const itemsPerPage = ref(20)

const orders = ref([])
const search = ref('')
const loading = ref(false)
const totalItems = ref(0)
const headers = ref([{
    title: 'Ordernummer',
    align: 'start',
    key: 'order_id',
},
{
    title: 'Klantnaam', key: 'fullname', align: 'start',
    sortRaw(a, b) {
        const nameA = `${a.contact.billing_firstname} ${a.contact.billing_lastname}`.toLowerCase()
        const nameB = `${b.contact.billing_firstname} ${b.contact.billing_lastname}`.toLowerCase()
        return nameA.localeCompare(nameB)
    }

},
{ title: 'Site', key: 'site', align: 'start' },
{ title: 'Bezorgopties', key: 'delivery_codes', align: 'start' },
{ title: 'Inleveren op', key: 'latest_handover_datetime', align: 'start' },
{ title: 'Orderdatum', key: 'order_date', align: 'start' },
{ title: 'Status', key: 'status', align: 'start' },
])

const loadItems = async (opts) => {
    loading.value = true
    const response = await axios.get('/api/orders', { params: { ...opts } })
    //console.log(response.data.data)
    orders.value = response.data.data
    totalItems.value = response.data.total
    loading.value = false
}

const getDeliveries = (options) => {
    return options.join(', ')
}

const formatDate = (date) => {
    if (!date) {
        return ''
    }
    return DateTime.fromISO(date).toFormat("dd-LL-yyyy 'om' HH:mm:ss")
}

</script>