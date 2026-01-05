<template>
  <v-container fluid>
    <v-card class="card z-index-2 h-100">
      <v-card-title>Nieuwe producten in batches uploaden</v-card-title>
      <v-card-text>
        <v-form @submit.prevent="handleUpload">
          <v-file-input
            v-model="fileInput"
            accept=".csv, .xlsx"
            label="Upload Product File"
            prepend-icon=""
            :error-messages="fileError"
            show-size
          >
            <template v-slot:prepend-inner>
              <v-icon class="mr-3">fa-file-upload</v-icon>
            </template>
          </v-file-input>

          <v-alert
            v-if="uploadStatus.show"
            :type="uploadStatus.type"
            :text="uploadStatus.message" 
          ></v-alert>

          <v-btn
            class="btn-primary mt-4"
            type="submit"
            :loading="isUploading"
            :disabled="!fileInput"
          >
            Upload Products
          </v-btn>
        </v-form>

        <v-card class="mt-4" v-if="uploadResults.length">
          <v-card-title>Upload Results</v-card-title>
          <v-table>
            <thead>
              <tr>
                <th>GTIN/EAN</th>
                <th>Title</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="result in uploadResults" :key="result.gtin">
                <td>{{ result.gtin }}</td>
                <td>{{ result.title }}</td>
                <td>
                  <v-chip
                    :color="result.success ? 'success' : 'error'"
                    text-color="white"
                  >
                    {{ result.message }}
                  </v-chip>
                </td>
              </tr>
            </tbody>
          </v-table>
        </v-card>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script setup>
import { ref } from 'vue'
import axios from '@/services/axios'
import * as XLSX from 'xlsx'

const fileInput = ref(null)
const fileError = ref('')
const isUploading = ref(false)
const uploadResults = ref([])
const uploadStatus = ref({
  show: false,
  type: 'info',
  message: ''
})

const handleUpload = async () => {
  if (!fileInput.value) {
    fileError.value = 'Please select a file'
    return
  }

  try {
    isUploading.value = true
    uploadStatus.value.show = true
    uploadStatus.value.type = 'info'
    uploadStatus.value.message = 'Processing file...'
    
    const file = fileInput.value;
    
    // Process products in batches of 10
    uploadResults.value = []
    
    const formData = new FormData();
    formData.append('file', file);
    
    console.log('formData:', formData);
    uploadStatus.value.message = 'Uploading products...'
    const response = await axios.post('/api/products/batch-upload', formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    });

    console.log("Res :",response);
    if (response.data.success) {
      uploadStatus.value.type = 'success'
      uploadStatus.value.message = response.data.message

      // reset file input
      fileInput.value = null
      
    } else {
      uploadStatus.value.type = 'error'
      uploadStatus.value.message = response.data.message || 'Upload failed'
    }

    if (response.data.results) {
      uploadResults.value = response.data.results.map(result => ({
      gtin: result.gtin,
      title: result.title,
      success: result.success,
      message: result.message || (result.success ? 'Success' : 'Failed')
      }))
    }
  } catch (error) {
    console.error('File upload error:', error);
    uploadResults.value = [{
    gtin: 'Error',
    title: 'File Upload Failed',
    success: false,
    message: error.message || 'Upload failed'
    }];
  } finally {
    isUploading.value = false
  }
}

const parseFile = async (file) => {
  return new Promise((resolve, reject) => {
    const reader = new FileReader()
    
    reader.onload = (e) => {
      try {
        const data = e.target.result
        const workbook = XLSX.read(data, { type: 'binary' })
        const firstSheet = workbook.Sheets[workbook.SheetNames[0]]
        const products = XLSX.utils.sheet_to_json(firstSheet)
        
        // Validate and format products
        const formattedProducts = products.map(product => ({
          gtin: String(product.gtin || product.ean).padStart(13, '0'),
          title: product.title || product.name,
          quantity: parseInt(product.quantity || product.stock) || 0,
          price: parseFloat(product.price || 0).toFixed(2),
          category: product.category_id || product.category,
          imageurl: product.imageurl || product.image_url || '',
          bricklink_id: product.bricklink_id || '' // For BrickLink compatibility
        }))

        resolve(formattedProducts)
      } catch (error) {
        console.error('Error parsing file:', error)
        reject(new Error('Error parsing file: ' + error.message))
      }
    }

    reader.onerror = () => reject(new Error('Error reading file'))
    reader.readAsBinaryString(file)
  })
}


</script>