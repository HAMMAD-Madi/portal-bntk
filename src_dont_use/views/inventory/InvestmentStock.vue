<template>
  <v-container fluid>
    <v-card class="card z-index-2 h-100">
      <v-card-title class="d-flex align-center mb-4">
        Investment Stock
        <v-spacer></v-spacer>
        <v-btn
          class="btn-primary"
          :to="{ name: 'inventory-new', query: { type: 'investment' }}"
        >
          Add Investment Item
        </v-btn>
      </v-card-title>

      <v-card-text>
        <!-- Filters -->
        <div class="d-flex align-center mb-4 gap-4">
          <v-text-field 
            v-model="search" 
            prepend-inner-icon="fas fa-magnifying-glass" 
            label="Search" 
            variant="outlined" 
            hide-details 
            class="flex-grow-1"
            clearable
          ></v-text-field>
          
          <v-select
            v-model="sortBy"
            :items="sortOptions"
            label="Sort By"
            variant="outlined"
            hide-details
            class="flex-shrink-0"
            style="min-width: 200px"
          ></v-select>
        </div>

        <!-- Investment Items Table -->
        <v-table>
          <thead>
            <tr>
              <th>GTIN</th>
              <th>Title</th>
              <th>Purchase Price</th>
              <th>Current Value</th>
              <th>Target Price</th>
              <th>Purchase Date</th>
              <th>Expected List Date</th>
              <th>ROI</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in sortedItems" :key="item.id">
              <td>{{ item.gtin }}</td>
              <td>{{ item.title }}</td>
              <td>{{ formatCurrency(item.purchase_price) }}</td>
              <td>{{ formatCurrency(item.price) }}</td>
              <td>{{ formatCurrency(item.target_price) }}</td>
              <td>{{ formatDate(item.purchase_date) }}</td>
              <td>{{ formatDate(item.expected_list_date) }}</td>
              <td :class="getRoiClass(item)">
                {{ calculateRoi(item) }}%
              </td>
              <td>
                <v-btn-group>
                  <v-btn
                    size="small"
                    icon
                    :to="`/voorraad/${item.gtin}`"
                  >
                    <v-icon class="text-primary">fa-pencil</v-icon>
                  </v-btn>
                  <v-btn
                    size="small"
                    icon
                    @click="convertToRegular(item)"
                  >
                    <v-icon class="text-success">fa-box</v-icon>
                  </v-btn>
                </v-btn-group>
              </td>
            </tr>
          </tbody>
        </v-table>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import axios from '@/services/axios'

const search = ref('')
const sortBy = ref('purchase_date')
const items = ref([])

const sortOptions = [
  { title: 'Purchase Date', value: 'purchase_date' },
  { title: 'Expected List Date', value: 'expected_list_date' },
  { title: 'ROI', value: 'roi' }
]

const loadInvestmentItems = async () => {
  try {
    const response = await axios.get('/api/products/investment', {
      params: { search: search.value }
    })
    items.value = response.data
  } catch (error) {
    console.error('Error loading investment items:', error)
  }
}

const sortedItems = computed(() => {
  let sorted = [...items.value]
  
  if (sortBy.value === 'roi') {
    sorted.sort((a, b) => calculateRoiValue(b) - calculateRoiValue(a))
  } else {
    sorted.sort((a, b) => new Date(b[sortBy.value]) - new Date(a[sortBy.value]))
  }
  
  return sorted
})

const calculateRoiValue = (item) => {
  if (!item.purchase_price) return 0
  return ((item.price - item.purchase_price) / item.purchase_price) * 100
}

const calculateRoi = (item) => {
  return calculateRoiValue(item).toFixed(2)
}

const getRoiClass = (item) => {
  const roi = calculateRoiValue(item)
  return {
    'text-success': roi > 0,
    'text-error': roi < 0,
    'text-grey': roi === 0
  }
}

const formatCurrency = (value) => {
  if (!value) return '-'
  return Number(value).toLocaleString('nl-NL', { 
    style: 'currency', 
    currency: 'EUR' 
  })
}

const formatDate = (date) => {
  if (!date) return '-'
  return new Date(date).toLocaleDateString('nl-NL')
}

const convertToRegular = async (item) => {
  try {
    await axios.patch(`/api/products/${item.id}/convert-to-regular`)
    await loadInvestmentItems()
  } catch (error) {
    console.error('Error converting item:', error)
  }
}

watch(search, () => {
  loadInvestmentItems()
})

watch(sortBy, () => {
  // Sorting is handled by the computed property
})

onMounted(() => {
  loadInvestmentItems()
})
</script>

<style scoped>
.text-success {
  color: #4caf50;
}

.text-error {
  color: #f44336;
}

.text-grey {
  color: #9e9e9e;
}
</style>