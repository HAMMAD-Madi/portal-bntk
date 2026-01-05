<template>
  <v-container fluid>
    <v-card class="card z-index-2 h-100">
      <v-card-title class="d-flex align-center">
        Voorraad Locaties
        <v-spacer></v-spacer>
        <v-btn
          class="btn-primary"
          @click="addLocation"
        >
          Add Location
        </v-btn>
      </v-card-title>

      <v-card-text>
        <v-table>
          <thead>
            <tr>
              <th>Name</th>
              <th>Code</th>
              <th>Description</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="location in locations" :key="location.id">
              <td>{{ location.name }}</td>
              <td>{{ location.code }}</td>
              <td>{{ location.description }}</td>
              <td>
                <v-btn-group>
                  <v-btn
                    size="small"
                    icon
                    @click="editLocation(location)"
                  >
                    <v-icon class="text-secondary">fa-pencil</v-icon>
                  </v-btn>
                  <v-btn
                    size="small"
                    icon
                    @click="confirmDelete(location)"
                  >
                    <v-icon class="text-danger">fa-trash</v-icon>
                  </v-btn>
                </v-btn-group>
              </td>
            </tr>
          </tbody>
        </v-table>
      </v-card-text>
    </v-card>

    <!-- Add/Edit Dialog -->
    <v-dialog v-model="showDialog" max-width="500px">
      <v-card>
        <v-card-title>{{ editedLocation.id ? 'Edit' : 'Add' }} Location</v-card-title>
        <v-card-text>
          <v-form @submit.prevent="saveLocation">
            <v-text-field
              v-model="editedLocation.name"
              label="Name"
              :error-messages="errors.name"
              required
            ></v-text-field>

            <v-text-field
              v-model="editedLocation.code"
              label="Code"
              :error-messages="errors.code"
              required
            ></v-text-field>

            <v-textarea
              v-model="editedLocation.description"
              label="Description"
              :error-messages="errors.description"
            ></v-textarea>
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text @click="showDialog = false">Cancel</v-btn>
          <v-btn color="primary" @click="saveLocation">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- Delete Confirmation Dialog -->
    <v-dialog v-model="showDeleteDialog" max-width="400px">
      <v-card>
        <v-card-title>Confirm Delete</v-card-title>
        <v-card-text>
          Are you sure you want to delete this location?
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text @click="showDeleteDialog = false">Cancel</v-btn>
          <v-btn color="error" @click="deleteLocation">Delete</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from '@/services/axios'

const locations = ref([])
const showDialog = ref(false) // This will be used for both add and edit
const showDeleteDialog = ref(false)
const errors = ref({})
const editedLocation = ref({
  id: null,
  name: '',
  code: '',
  description: ''
})
const locationToDelete = ref(null)

const loadLocations = async () => {
  try {
    const response = await axios.get('/api/stock-locations')
    locations.value = response.data
  } catch (error) {
    console.error('Error loading locations:', error)
  }
}

const editLocation = (location) => {
  editedLocation.value = { ...location }
  showDialog.value = true
}

const confirmDelete = (location) => {
  locationToDelete.value = location
  showDeleteDialog.value = true
}

const addLocation = () => {
  editedLocation.value = { id: null, name: '', code: '', description: '' }
  showDialog.value = true
}

const saveLocation = async () => {
  try {
    if (editedLocation.value.id) {
      await axios.put(`/api/stock-locations/${editedLocation.value.id}`, editedLocation.value)
    } else {
      await axios.post('/api/stock-locations', editedLocation.value)
    }
    await loadLocations()
    showDialog.value = false
    editedLocation.value = { id: null, name: '', code: '', description: '' }
    errors.value = {}
  } catch (error) {
    if (error.response?.data?.errors) {
      errors.value = error.response.data.errors
    }
  }
}

const deleteLocation = async () => {
  try {
    await axios.delete(`/api/stock-locations/${locationToDelete.value.id}`)
    await loadLocations()
    showDeleteDialog.value = false
    locationToDelete.value = null
  } catch (error) {
    console.error('Error deleting location:', error)
  }
}

onMounted(() => {
  loadLocations()
})
</script>