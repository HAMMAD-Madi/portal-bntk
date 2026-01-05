<template>
  <v-dialog v-model="show" max-width="600">
    <v-card>
      <v-card-title>Update Stock Locations</v-card-title>
      
      <v-card-text>
        <v-row>
          <v-col cols="12">
            <v-select
              v-model="selectedLocation"
              :items="locations"
              item-title="name"
              item-value="id"
              label="Location"
              variant="outlined"
              :error-messages="locationError"
            />
          </v-col>
          
          <!-- <v-col cols="12">
            <v-text-field
              v-model="shelfPosition"
              label="Shelf Position"
              variant="outlined"
              placeholder="e.g., A-01-02"
            />
          </v-col> -->
        </v-row>

        <!-- Selected Products Table -->
        <v-table>
          <thead>
            <tr>
              <th>GTIN</th>
              <th>Title</th>
              <th>Current Location</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="product in selectedProducts" :key="product.id">
              <td>{{ product.gtin }}</td>
              <td>{{ product.title }}</td>
              <td>
                {{ getLocationName(product.location_id) }}
              </td>
            </tr>
          </tbody>
        </v-table>
      </v-card-text>

      <v-card-actions>
        <v-spacer />
        <v-btn
          color="grey-darken-1"
          variant="text"
          @click="close"
        >
          Cancel
        </v-btn>
        <v-btn
          color="primary"
          :loading="isUpdating"
          :disabled="!selectedLocation"
          @click="updateLocations"
        >
          Update Locations
        </v-btn>
      </v-card-actions>

      <!-- Status Snackbar -->
      <v-snackbar
        v-model="showSnackbar"
        :color="snackbarColor"
        timeout="3000"
      >
        {{ snackbarText }}
      </v-snackbar>
    </v-card>
  </v-dialog>
</template>

<script setup>
import { ref, computed } from 'vue'
import axios from '@/services/axios'

const props = defineProps({
  modelValue: Boolean,
  selectedProducts: {
    type: Array,
    required: true
  }
})

const emit = defineEmits(['update:modelValue', 'updated'])

const show = computed({
  get: () => props.modelValue,
  set: (value) => emit('update:modelValue', value)
})

const selectedLocation = ref(null)
const shelfPosition = ref('')
const locations = ref([])
const isUpdating = ref(false)
const locationError = ref('')
const showSnackbar = ref(false)
const snackbarText = ref('')
const snackbarColor = ref('success')

const close = () => {
  show.value = false
  selectedLocation.value = null
  shelfPosition.value = ''
  locationError.value = ''
}

const getLocationName = (locationId) => {
  const location = locations.value.find(l => l.id === locationId)
  return location ? location.name : 'No Location'
}

const loadLocations = async () => {
  try {
    const response = await axios.get('/api/stock-locations')
    locations.value = response.data
  } catch (error) {
    console.error('Error loading locations:', error)
    snackbarText.value = 'Error loading locations'
    snackbarColor.value = 'error'
    showSnackbar.value = true
  }
}

const updateLocations = async () => {
  if (!selectedLocation.value) {
    locationError.value = 'Please select a location'
    return
  }

  isUpdating.value = true
  try {
    await axios.post('/api/products/bulk-update-location', {
      product_ids: props.selectedProducts.map(p => p.id),
      location_id: selectedLocation.value,
      shelf_position: shelfPosition.value || null
    })

    snackbarText.value = 'Locations updated successfully'
    snackbarColor.value = 'success'
    showSnackbar.value = true
    emit('updated')
    close()
  } catch (error) {
    console.error('Error updating locations:', error)
    snackbarText.value = error.response?.data?.message || 'Error updating locations'
    snackbarColor.value = 'error'
    showSnackbar.value = true
  } finally {
    isUpdating.value = false
  }
}

loadLocations()
</script>