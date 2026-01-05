<template>
  <router-view></router-view>

  <v-container fluid>
    <v-card class="card z-index-2 h-100">
      <v-card-text class="card-body p-3">
        <!-- Search and Actions Row -->
        <div class="d-flex align-center mb-5 gap-4">
          <v-text-field 
            v-model="search" 
            prepend-inner-icon="fas fa-magnifying-glass" 
            label="Zoeken" 
            single-line
            variant="outlined" 
            hide-details 
            class="flex-grow-1" 
            clearable
          ></v-text-field>
          
          <!-- Category Filter -->
          <v-select
            v-model="selectedCategory"
            :items="categories"
            item-value="id"
            item-title="title"
            label="Category"
            variant="outlined"
            hide-details
            class="flex-shrink-0"
            style="min-width: 200px"
            clearable
          ></v-select>
          
          <!-- Condition Filter -->
          <v-select
            v-model="selectedCondition"
            :items="conditions"
            label="Condition"
            variant="outlined"
            hide-details
            class="flex-shrink-0"
            style="min-width: 150px"
            clearable
          ></v-select>
          
          
        </div>

        <!-- Add this after the filters and before v-data-iterator -->
        <div class="d-flex align-center mb-3">
          <v-checkbox
            v-model="selectAll"
            label="Select All Items"
            hide-details
            @change="toggleSelectAll"
          ></v-checkbox>
          <v-spacer></v-spacer>

          <!-- Bulk Actions -->
          <v-btn
            v-if="selectedProducts.length"
            class="btn-primary"
            @click="showBulkUpdateDialog = true"
          >
            Update Stock ({{ selectedProducts.length }})
          </v-btn>
          <!-- color="secondary" -->
          <v-btn
            v-if="selectedProducts.length"
            class="btn-secondary ms-2"
            @click="showLocationUpdate = true"
          >
            Update Locations ({{ selectedProducts.length }})
          </v-btn>
        </div>

        <v-data-iterator 
          @update:options="updateOptions" 
          :search="search" 
          :page="page" 
          :items-per-page="itemsPerPage"
          :items="products"
        >
          <template v-slot:default="{ items }">
            <v-row align="start">
              <v-col cols="12" md="6" lg="4" xl="3" v-for="product in items" :key="product.id">
                <v-card>
                  <!-- Selection Checkbox -->
                  <!-- @update:model-value="toggleProductSelection(product.raw)" -->
                  <v-checkbox
                    v-model="selectedProducts"
                    :value="product.raw"
                    class="ma-2"
                    hide-details
                  ></v-checkbox>

                  <!-- Existing Card Content -->
                  <v-img 
                    v-if="product.raw.imageurl" 
                    height="200" 
                    :src="`${product.raw.imageurl}`"
                    class="text-white"
                  ></v-img>
                  <v-img 
                    v-else 
                    height="200" 
                    :src="`https://portal.bntk.eu${product.raw.main_image}`"
                    class="text-white"
                  ></v-img>
                  <v-card-title>{{ product.raw.title }}</v-card-title>
                  <v-card-text>
                    <div class="product-info-container">
                      <div class="product-info">Voorraad:</div>
                      <div class="product-info">{{ product.raw.stock }}</div>
                      <div class="product-info">Prijs</div>
                      <div class="product-info">{{ currency(product.raw.price) }}</div>
                      <div class="product-info">Condition:</div>
                      <div class="product-info">
                        <v-chip
                          :color="product.raw.condition === 'new' ? 'success' : 'warning'"
                          size="small"
                        >
                          {{ product.raw.condition === 'new' ? 'New' : 'Used' }}
                        </v-chip>
                      </div>
                    </div>
                    <div class="bruh" style="display: flex; justify-content: center; gap: 50px">
                      <!-- <v-btn style="font-size:12px;" @click="showPrinterDialog(product.raw)" size="small"  icon="custom:printerIcon"></v-btn> -->
                      <!-- <v-btn style="font-size:16px;"  size="small"  icon="fa-clock-rotate-left"></v-btn> -->
                      <v-btn v-if="!product.raw.is_trashed" @click="productQuantity(product, 'minus')"
                        class="btn-info" size="small" icon><v-icon>fa-minus</v-icon></v-btn>
                      <v-btn v-if="!product.raw.is_trashed" @click="productQuantity(product, 'plus')"
                        class="btn-info" size="small" icon><v-icon>fa-plus</v-icon></v-btn>
                    </div>
                    <div class="my-5" style="display: flex; justify-content: center;">
                      <v-btn
                        :to="`/voorraad/${product.raw.gtin}`" class="btn-primary w-100 mt-4 mb-0"><span
                          v-if="!product.raw.is_trashed">Wijzigen</span><span v-else>Product herstellen</span></v-btn>
                          <!-- style="color: white" block
                        :color="getButtonColor(product.raw)" dark -->
                    </div>

                    <div style="display: flex; justify-content: center;">
                      <vue-barcode :value="product.raw.gtin"
                        :options="{ displayValue: true, height: 50 }"></vue-barcode>

                    </div>

                  </v-card-text>
                </v-card>


              </v-col>
            </v-row>
            <v-pagination v-model="page" :length="pageCount" :total-visible="7"></v-pagination>
          </template>
        </v-data-iterator>

        <!-- Bulk Update Dialog -->
        <v-dialog
          v-model="showBulkUpdateDialog"
          max-width="600px"
        >
          <bulk-stock-update 
            :selected-products="selectedProducts"
            @update-complete="handleBulkUpdateComplete"
          />
        </v-dialog>

        <!-- Bulk Location Update Dialog -->
        <bulk-location-update
          v-model="showLocationUpdate"
          :selected-products="selectedProducts"
          @updated="handleLocationUpdate"
        />

      </v-card-text>
    </v-card>
  </v-container>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import axios from '@/services/axios'
import { useRoute, useRouter } from 'vue-router'
import BulkStockUpdate from '@/components/BulkStockUpdate.vue'
import BulkLocationUpdate from '@/components/BulkLocationUpdate.vue'

const search = ref('')
const products = ref([])
const page = ref(1)
const itemsPerPage = ref(12)
const total = ref()
const selectedProducts = ref([])
const showBulkUpdateDialog = ref(false)
const showLocationUpdate = ref(false)
const selectedCategory = ref(null)
const selectedCondition = ref(null)
const categories = ref([])
const conditions = ref([
  { title: 'New', value: 'new' },
  { title: 'Used', value: 'used' }
])
const selectAll = ref(false)

const pageCount = computed(() => {
  return Math.ceil(total.value / itemsPerPage.value)
})

const route = useRoute()
const router = useRouter()

const handleBulkUpdateComplete = async (success) => {
  if (success) {
    showBulkUpdateDialog.value = false
    selectedProducts.value = []
    // Refresh the products list
    await getProducts(page.value)
  }
}

const handleLocationUpdate = async () => {
  showLocationUpdate.value = false
  selectedProducts.value = []
  await getProducts(page.value)
}

const productQuantity = async (product, operation) => {
  const index = products.value.findIndex(p => product.id == p.id)

  if (operation == 'plus') {
    await axios.post('/api/product/quantity', { id: product.raw.id, operation: operation })
    product.raw.stock += 1
    products.value[index] = product
  } else if (operation == 'minus' && product.raw.stock > 0) {
    product.raw.stock -= 1
    products.value[index] = product
    await axios.post('/api/product/quantity', { id: product.raw.id, operation: operation })
  }
}

watch(page, (newPage) => {
  getProducts(newPage)
})

watch(search, () => {
  getProducts(1)
})

watch(selectedCategory, () => {
  page.value = 1 // Reset to first page when changing category
  getProducts(1)
})

watch(selectedCondition, () => {
  page.value = 1 // Reset to first page when changing condition
  getProducts(1)
})

const getCategories = async () => {
  try {
    const response = await axios.get('/api/categorylist')
    // categories.value = response.data
    //only set categories name and id

    if (!response.data || !Array.isArray(response.data)) {
      console.error('Invalid categories data:', response.data)
      return
    }

    // Deduplicate by ID and only use required fields
    const unique = new Map()
    response.data.forEach(cat => {
      if (!unique.has(cat.id)) {
        unique.set(cat.id, {
          id: cat.id,
          title: cat.title // match `item-title="title"`
        })
      }
    })

    categories.value = Array.from(unique.values())
  } catch (error) {
    console.error('Error fetching categories:', error)
  }
}

const getProducts = async (page = 1) => {
  const response = await axios.get('/api/product', { 
    params: { 
      page: page, 
      search: search.value,
      category: selectedCategory.value,
      condition: selectedCondition.value
    } 
  })
  total.value = response.data.total
  products.value = response.data.data
}

onMounted(async () => {
  await getCategories()
  getProducts(1)
})

const currency = (amount) => {
  return Number(amount).toLocaleString('nl-NL', { style: 'currency', currency: 'EUR' })
}


// New method to toggle select all
const toggleSelectAll = () => {
  console.log(selectAll.value);
  if (selectAll.value) {
    // Select all products in the current view
    console.log("products.value", products.value);
    const currentProducts = products.value.map(product => product)
    selectedProducts.value = currentProducts
    console.log(selectedProducts);
  } else {
    // Deselect all products
    selectedProducts.value = []
  }
}

const isAllSelected = computed(() => {
  return selectedProducts.value.length === products.value.length
})

// const toggleSelectAll = (event) => {
//   if (event.target.checked) {
//     selectedProducts.value = products.value.map(item => item.id)
//   } else {
//     selectedProducts.value = []
//   }
// }

// Update the watch for selectedProducts to properly handle select all state
watch(selectedProducts, (newValue) => {
  // Update selectAll based on whether all current page items are selected
  const currentPageProducts = products.value.map(product => product.raw)
  const allCurrentSelected = currentPageProducts.every(product => 
    newValue.some(selected => selected.id === product.id)
  )
  selectAll.value = allCurrentSelected && currentPageProducts.length > 0
}, { deep: true })

// Add this watch to handle partial selection state
watch(selectedProducts, (newValue) => {
  // Update selectAll based on whether all items are selected
  selectAll.value = newValue.length === products.value.length && newValue.length > 0
}, { deep: true })

// Update existing watch for products to handle selectAll state
watch(products, () => {
  // Reset selectAll when products change (page change, filter, etc.)
  selectAll.value = false
  selectedProducts.value = []
})

// Add these new methods after your existing methods
// const isProductSelected = (product) => {
//   return selectedProducts.value.some(p => p.id === product.id)
// }

// const toggleProductSelection = (product) => {
//   const index = selectedProducts.value.findIndex(p => p.id === product.id)
//   console.log("Index" , index)
//   if (index === -1) {
//     selectedProducts.value.push(product)
//   } else {
//     selectedProducts.value.splice(index, 1)
//   }
// }
</script>

<style scoped>
.product-info {
  width: 100%
}

.product-info-container {
  display: flex;
  flex-wrap: wrap;
}

.product-info-container > div {
  flex: 50%;
  margin-bottom: 10px;
}

.gap-4 {
  gap: 1rem;
}
</style>