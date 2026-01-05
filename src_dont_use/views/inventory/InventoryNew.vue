<template>
  <v-container fluid>
    <v-card class="card z-index-2 h-100">
      <v-card-text class="card-body p-3">
        <v-form @submit.prevent="onSubmit">
          <v-text-field 
            v-model="gtin.value.value" 
            label="EAN code" 
            variant="outlined"
            :error-messages="gtin.errorMessage.value"
          >
            <template #append-inner>
              <v-btn @click="generateEan()">Genereer</v-btn>
            </template>
          </v-text-field>

          <v-text-field 
            v-model="title.value.value" 
            label="Titel" 
            variant="outlined"
            :error-messages="title.errorMessage.value"
          ></v-text-field>

          <v-text-field 
            v-model="quantity.value.value" 
            label="Aantal" 
            variant="outlined"
            :error-messages="quantity.errorMessage.value"
          ></v-text-field>

          <v-text-field 
            v-model="price.value.value" 
            label="Prijs" 
            variant="outlined"
            :error-messages="price.errorMessage.value"
          ></v-text-field>

          <v-autocomplete 
            v-model="category.value.value" 
            :items="categories" 
            item-value="id"
            item-title="title" 
            label="Categorie" 
            variant="outlined"
            :error-messages="category.errorMessage.value"
          >
            <template #append>
              <v-btn class="btn-primary">Categorie toevoegen</v-btn>
            </template>
          </v-autocomplete>

          <v-select
            v-model="condition.value.value"
            :items="conditions"
            label="Condition"
            variant="outlined"
            :error-messages="condition.errorMessage.value"
          ></v-select>

          <v-select
            v-model="location.value.value"
            :items="locations"
            item-title="name"
            item-value="id"
            label="Location"
            variant="outlined"
            :error-messages="location.errorMessage.value"
            clearable
          ></v-select>

          <!-- <v-text-field
            v-model="shelfPosition.value.value"
            label="Shelf Position"
            variant="outlined"
            :error-messages="shelfPosition.errorMessage.value"
            placeholder="e.g., A-01-02"
          ></v-text-field> -->

          <!-- Rest of the form fields -->
          <v-text-field 
            v-model="imageurl.value.value" 
            label="Afbeelding URL" 
            variant="outlined"
            :error-messages="imageurl.errorMessage.value"
          ></v-text-field>

          <v-switch
            v-model="isInvestment.value.value"
            label="Investment Item"
            variant="outlined"
            
          ></v-switch>

          <template v-if="isInvestment.value.value">
            <v-text-field
              v-model="purchasePrice.value.value"
              label="Purchase Price"
              variant="outlined"
              :error-messages="purchasePrice.errorMessage.value"
            ></v-text-field>

            <v-text-field
              v-model="targetPrice.value.value"
              label="Target Price"
              variant="outlined"
              :error-messages="targetPrice.errorMessage.value"
            ></v-text-field>

            <v-text-field
              type="date"
              v-model="purchaseDate.value.value"
              label="Purchase Date"
              variant="outlined"
              :error-messages="purchaseDate.errorMessage.value"
            ></v-text-field>

            <v-text-field
              type="date"
              v-model="expectedListDate.value.value"
              label="Expected List Date"
              variant="outlined"
              :error-messages="expectedListDate.errorMessage.value"
            ></v-text-field>

            <v-textarea
              v-model="investmentNotes.value.value"
              label="Investment Notes"
              variant="outlined"
              :error-messages="investmentNotes.errorMessage.value"
            ></v-textarea>
          </template>

          <!-- Submit buttons -->
          <v-row>
            <v-col cols="auto">
              <v-btn class="btn-primary" type="submit">Opslaan</v-btn>
            </v-col>
          </v-row>
        </v-form>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useForm, useField } from 'vee-validate'
import * as yup from 'yup'
import '@/languages/yup-nl_NL.js'
import { setLocale } from 'yup'
import axios from '@/services/axios'
import { useRoute } from 'vue-router'

const route = useRoute()

setLocale({
    mixed: {
        default: '${field} is niet geldig',
        required: ({label, values}) => `${label} is een verplicht veld`,
        oneOf: 'moet een van de volgende waarden zijn: ${values}',
        notOneOf: 'mag niet een van de volgende waarden zijn: ${values}',
    },
    string: {
        length: 'moet precies ${length} karakters lang zijn',
        min: 'moet minstens ${min} karakters bevatten',
        max: 'mag maximaal ${max} karakters bevatten',
        email: 'moet een geldig e-mailadres zijn',
        url: 'moet een geldige URL zijn',
    },
    number: {
        integer: `moet een getal zijn`,
        number: ({label, values}) => `${label} moet een getal zijn`,
        positive: ({label, values}) => `${label} moet een getal hoger dan 0 zijn`,
        min: 'moet groter dan of gelijk zijn aan ${min}',
        max: 'moet kleiner dan of gelijk zijn aan ${max}',
    },
});

const schema = yup.object().shape({
  title: yup.string().required().label('Titel'),
  quantity: yup.number().typeError((obj) => `${obj.label} moet een getal zijn`).required().positive().integer().label('Aantal'),
  price: yup.string().test('is-decimal', 'Prijs is ongeldig', value => (value + "").match(/^\d+(,\d{1,2})?$/)).label('Prijs'),
  category: yup.string().required().label('Categorie'),
  imageurl: yup.string().notRequired().label('Afbeelding URL'),
  gtin: yup.number().typeError((obj) => `${obj.label} moet een getal zijn`).required().test('len', 'EAN code moet precies 13 cijfers bevatten', val => val.toString().length === 13).label('EAN code'),
  condition: yup.string().required().oneOf(['new', 'used']).label('Condition'),
  location_id: yup.number().nullable(),
  // shelf_position: yup.string().nullable().max(50)
})

const { handleSubmit, errors } = useForm({
  validationSchema: schema
})

// Form fields
const title = useField('title')
const quantity = useField('quantity')
const category = useField('category')
const price = useField('price')
const imageurl = useField('imageurl')
const gtin = useField('gtin')
const condition = useField('condition')
const location = useField('location_id')
// const shelfPosition = useField('shelf_position')
const isInvestment = useField('is_investment', undefined, {
  initialValue: route?.query?.type === 'investment' || false
})
const purchasePrice = useField('purchase_price')
const targetPrice = useField('target_price')
const purchaseDate = useField('purchase_date')
const expectedListDate = useField('expected_list_date')
const investmentNotes = useField('investment_notes')

// Data refs
const categories = ref([])
const locations = ref([])
const conditions = [
  { title: 'New', value: 'new' },
  { title: 'Used', value: 'used' }
]

// Methods
const loadLocations = async () => {
  try {
    const response = await axios.get('/api/stock-locations')
    locations.value = response.data
  } catch (error) {
    console.error('Error loading locations:', error)
  }
}

const generateEan = async () => {
  const response = await axios.get('/api/generate-ean')
  gtin.value.value = response.data
}

const onSubmit = handleSubmit(async (values) => {
  try {
    await axios.post('/api/product', values)
    // Reset form or redirect after success
  } catch (error) {
    console.error('Error creating product:', error)
  }
})

onMounted(async () => {
  await loadLocations()
  // Load categories
  const response = await axios.get('/api/categorylist')
  categories.value = response.data
})
</script>

<style scoped>
.image-container {
  position: relative;
}

.image-size {
  max-width: 100%;
  height: auto;
}

.overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
}

.delete-btn,
.download-btn {
  position: absolute;
  top: 10px;
  z-index: 10;
}

.delete-btn {
  left: 10px;
}

.download-btn {
  right: 10px;
}

/* .btn-primary {
  background-color: #1976d2;
  color: white;
}

.btn-primary:hover {
  background-color: #1565c0;
} */

.card {
  border-radius: 8px;
  overflow: hidden;
}

.card-body {
  padding: 16px;
}
</style>


