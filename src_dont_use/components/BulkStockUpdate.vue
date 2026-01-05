<template>
  <div class="bulk-stock-update">
    <div class="card shadow-lg">
      <div class="card-header">
        <h4>Update Stock Levels</h4>
      </div>
      <div class="card-body">
        <div class="mb-3">
          <label class="form-label">Stock Adjustment</label>
          <div class="input-group mb-3">
            <select v-model="updateType" class="form-select">
              <option value="set">Set to</option>
              <option value="add">Add</option>
              <option value="subtract">Subtract</option>
            </select>
            <input 
              type="number" 
              class="form-control" 
              v-model="stockValue"
              min="0"
              placeholder="Enter quantity"
            >
            <button 
              class="btn btn-primary" 
              @click="updateStock"
              :disabled="!selectedProducts.length || isUpdating"
            >
              <span v-if="isUpdating" class="spinner-border spinner-border-sm me-1"></span>
              {{ isUpdating ? 'Updating...' : 'Update Stock' }}
            </button>
          </div>
        </div>

        <!-- Selected Products Table -->
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>GTIN</th>
                <th>Title</th>
                <th>Current Stock</th>
                <th>New Stock</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="product in selectedProducts" :key="product.gtin">
                <td>{{ product.gtin }}</td>
                <td>{{ product.title }}</td>
                <td>{{ product.stock }}</td>
                <td>
                  {{ calculateNewStock(product.stock) }}
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Results -->
        <div v-if="results.length" class="mt-4">
          <h5>Update Results</h5>
          <div class="table-responsive">
            <table class="table table-sm">
              <tbody>
                <tr v-for="result in results" :key="result.gtin">
                  <td>{{ result.title }}</td>
                  <td>
                    <span 
                      class="badge"
                      :class="result.success ? 'bg-success' : 'bg-danger'"
                    >
                      {{ result.success ? 'Success' : 'Error' }}
                    </span>
                  </td>
                  <td>{{ result.message }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import axios from 'axios'

const props = defineProps({
  selectedProducts: {
    type: Array,
    required: true
  }
})

const emit = defineEmits(['update-complete'])

const updateType = ref('set')
const stockValue = ref(0)
const isUpdating = ref(false)
const results = ref([])
const snackbarText = ref('')
const snackbarColor = ref('')
const showSnackbar = ref(false)

const calculateNewStock = (currentStock) => {
  switch(updateType.value) {
    case 'set':
      return stockValue.value
    case 'add':
      return currentStock + stockValue.value
    case 'subtract':
      return Math.max(0, currentStock - stockValue.value)
    default:
      return currentStock
  }
}

const updateStock = async () => {
  if (!props.selectedProducts.length || !stockValue.value) return

  isUpdating.value = true
  try {
    const updates = props.selectedProducts.map(product => ({
      gtin: product.gtin,
      stock: calculateNewStock(product.stock)
    }))

    const response = await axios.post('/api/products/bulk-update-stock', { updates })

    if (response.data.success) {
      snackbarText.value = 'Stock levels updated successfully'
      snackbarColor.value = 'success'
      showSnackbar.value = true
      emit('update-complete', true) // Emit with success flag
    }
  } catch (error) {
    console.error('Update error:', error)
    snackbarText.value = error.response?.data?.message || 'Error updating stock levels'
    snackbarColor.value = 'error'
    showSnackbar.value = true
    emit('update-complete', false) // Emit with failure flag
  } finally {
    isUpdating.value = false
  }
}
</script>

<style scoped>
.bulk-stock-update {
  max-width: 1200px;
  margin: 0 auto;
}

.badge {
  padding: 6px 12px;
}
</style>