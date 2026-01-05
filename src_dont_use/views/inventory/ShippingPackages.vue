<template>
  <v-container fluid>
    <v-card class="card z-index-2 h-100">
      <v-card-title class="d-flex justify-space-between align-center">
        
        <v-btn
          class="btn-primary"
          @click="showCreateDialog = true"
        >
          Create Package
        </v-btn>
      </v-card-title>

      <v-card-text>
        <!-- Status Filter -->
        <v-select
          v-model="selectedStatus"
          :items="statusOptions"
          label="Filter by Status"
          clearable
        ></v-select>

        <!-- Packages Table -->
        <v-table>
          <thead>
            <tr>
              <th>Package ID</th>
              <th>Status</th>
              <th>Items</th>
              <th>Created</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="shipment in packages" :key="shipment.id">
              <td>{{ shipment.package_id }}</td>
              <td>
                <v-chip
                  :color="getStatusColor(shipment.status)"
                  size="small"
                >
                  {{ shipment.status }}
                </v-chip>
              </td>
              <td>{{ shipment.items.length }} items</td>
              <td>{{ new Date(shipment.created_at).toLocaleDateString() }}</td>
              <td>
                
                <v-btn-group>
                  <v-btn
                    size="small" icon
                    @click="viewPackage(shipment)"
                  >
                    <v-icon class="text-primary">fa-eye</v-icon>
                  </v-btn>
                  <v-btn
                    v-if="shipment.status !== 'shipped'"
                    size="small" icon
                    @click="updateStatus(shipment)"
                  >
                    <v-icon class="text-info">fa-pencil</v-icon>
                  </v-btn>
                  <v-btn
                    v-if="shipment.status === 'pending'"
                    size="small" icon
                    @click="returnToInventory(shipment)"
                  >
                    <v-icon class="text-danger">fa-undo</v-icon>
                  </v-btn>
                </v-btn-group>
              </td>
            </tr>
          </tbody>
        </v-table>
      </v-card-text>
    </v-card>

    <!-- Create Package Dialog -->
    <v-dialog v-model="showCreateDialog" max-width="800px">
      <v-card>
        <v-card-title>Create Shipping Package</v-card-title>
        <v-card-text>
          <v-form @submit.prevent="createPackage">
            <!-- Package Items -->
            <div v-for="(item, index) in newPackage.items" :key="index">
              <v-row>
                <v-col cols="6">
                  <v-autocomplete
                    v-model="item.gtin"
                    :items="availableProducts"
                    item-title="title"
                    item-value="gtin"
                    label="Product"
                  ></v-autocomplete>
                </v-col>
                <v-col cols="3">
                  <v-text-field
                    v-model="item.quantity"
                    type="number"
                    label="Quantity"
                    min="1"
                  ></v-text-field>
                </v-col>
                <!-- <v-col cols="3">
                  <v-select
                    v-model="item.condition"
                    :items="['new', 'used']"
                    label="Condition"
                  ></v-select>
                </v-col> -->
              </v-row>
            </div>

            <v-btn
              text
              @click="addItem"
            >
              Add Item
            </v-btn>

            <v-textarea
              v-model="newPackage.notes"
              label="Notes"
              rows="3"
            ></v-textarea>
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            text
            @click="showCreateDialog = false"
          >
            Cancel
          </v-btn>
          <v-btn
            color="primary"
            @click="createPackage"
            :loading="isCreating"
          >
            Create
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- View Package Dialog -->
    <v-dialog v-model="showViewDialog" max-width="800px">
      <v-card v-if="selectedShipment">
        <v-card-title>Package Details</v-card-title>
        <v-card-text>
          <v-list>
            <v-list-item>
              <v-list-item-title>Package ID</v-list-item-title>
              <v-list-item-subtitle>{{ selectedShipment.package_id }}</v-list-item-subtitle>
            </v-list-item>
            <v-list-item>
              <v-list-item-title>Status</v-list-item-title>
              <v-list-item-subtitle>
                <v-chip :color="getStatusColor(selectedShipment.status)" size="small">
                  {{ selectedShipment.status }}
                </v-chip>
              </v-list-item-subtitle>
            </v-list-item>
            <v-list-item>
              <v-list-item-title>Items</v-list-item-title>
            </v-list-item>
            <v-divider></v-divider>
            <v-list-item v-for="item in selectedShipment.items" :key="item.id">
              <v-list-item-title>{{ item.product.title }}</v-list-item-title>
              <v-list-item-subtitle>Quantity: {{ item.quantity }}</v-list-item-subtitle>
            </v-list-item>
          </v-list>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text @click="showViewDialog = false">Close</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- Update Status Dialog -->
    <v-dialog v-model="showStatusDialog" max-width="400px">
      <v-card v-if="selectedShipment">
        <v-card-title>Update Status</v-card-title>
        <v-card-text>
          <v-select
            v-model="newStatus"
            :items="statusOptions"
            label="New Status"
            item-title="title"
            item-value="value"
          ></v-select>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text @click="showStatusDialog = false">Cancel</v-btn>
          <v-btn color="primary" @click="confirmStatusUpdate">Update</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- Error Snackbar -->
    <v-snackbar
      v-model="showError"
      color="error"
      timeout="5000"
      location="top"
    >
      {{ errorMessage }}
      <template v-slot:actions>
        <v-btn
          color="white"
          variant="text"
          @click="showError = false"
        >
          Close
        </v-btn>
      </template>
    </v-snackbar>
  </v-container>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue'
import axios from '@/services/axios'

const packages = ref([])
const selectedStatus = ref(null)
const showCreateDialog = ref(false)
const isCreating = ref(false)
const availableProducts = ref([])
const showError = ref(false)
const errorMessage = ref('')

// Add these new refs for dialogs
const showViewDialog = ref(false)
const showStatusDialog = ref(false)
const selectedShipment = ref(null)
const newStatus = ref('')

const statusOptions = [
  { title: 'Pending', value: 'pending' },
  { title: 'Ready', value: 'ready' },
  { title: 'Shipped', value: 'shipped' }
]

const newPackage = ref({
  items: [{ gtin: null, quantity: 1, condition: 'new' }],
  notes: ''
})

const getStatusColor = (status) => {
  switch (status) {
    case 'pending': return 'warning'
    case 'ready': return 'info'
    case 'shipped': return 'success'
    default: return 'grey'
  }
}

const loadPackages = async () => {
  try {
    const response = await axios.get('/api/shipping-packages', {
      params: {
        status: selectedStatus.value
      }
    })
    packages.value = response.data.data
  } catch (error) {
    console.error('Error loading packages:', error)
    errorMessage.value = error.response?.data?.message || 
                        'Error loading shipping packages'
    showError.value = true
  }
}

const loadProducts = async () => {
  try {
    const response = await axios.get('/api/product')
    availableProducts.value = response.data.data
  } catch (error) {
    console.error('Error loading products:', error)
    errorMessage.value = error.response?.data?.message || 
                        'Error loading products'
    showError.value = true
  }
}

const createPackage = async () => {
  try {
    isCreating.value = true
    await axios.post('/api/shipping-packages', newPackage.value)
    showCreateDialog.value = false
    loadPackages()
    
    // Reset form
    newPackage.value = {
      items: [{ gtin: null, quantity: 1, condition: 'new' }],
      notes: ''
    }
  } catch (error) {
    console.error('Error creating package:', error)
    errorMessage.value = error.response?.data?.message || 
                        error.response?.data?.error || 
                        'Error creating shipping package'
    showError.value = true
  } finally {
    isCreating.value = false
  }
}

const addItem = () => {
  newPackage.value.items.push({
    gtin: null,
    quantity: 1,
    condition: 'new'
  })
}

const viewPackage = (shipment) => {
  selectedShipment.value = shipment
  showViewDialog.value = true
}

const updateStatus = async (shipment) => {
  selectedShipment.value = shipment
  showStatusDialog.value = true
}

const returnToInventory = async (shipment) => {
  try {
    await axios.post(`/api/shipping-packages/${shipment.id}/return`)
    await loadPackages() // Refresh the list
  } catch (error) {
    errorMessage.value = error.response?.data?.message || 'Error returning items to inventory'
    showError.value = true
  }
}

const confirmStatusUpdate = async () => {
  try {
    await axios.patch(`/api/shipping-packages/${selectedShipment.value.id}/status`, {
      status: newStatus.value
    })
    showStatusDialog.value = false
    await loadPackages() // Refresh the list
  } catch (error) {
    errorMessage.value = error.response?.data?.message || 'Error updating status'
    showError.value = true
  }
}

watch(selectedStatus, () => {
  loadPackages()
})

onMounted(() => {
  loadPackages()
  loadProducts()
})
</script>