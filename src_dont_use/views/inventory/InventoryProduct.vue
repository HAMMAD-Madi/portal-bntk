<template>
  <v-container fluid>
    <v-card class="card z-index-2 h-100">
      <v-card-text class="card-body p-3">
        <v-form @submit.prevent="onSubmit">
          <v-text-field v-model="gtin.value.value" label="EAN code" variant="outlined"
            :error-messages="gtin.errorMessage.value">
            <template #append-inner><v-btn @click="generateEan()">Genereer</v-btn></template>
          </v-text-field>
          <v-text-field v-model="title.value.value" label="Titel" variant="outlined"
            :error-messages="title.errorMessage.value">
          </v-text-field>
          <v-text-field v-model="quantity.value.value" label="Aantal" variant="outlined"
            :error-messages="quantity.errorMessage.value">
          </v-text-field>
          <v-text-field v-model="price.value.value" label="Prijs" variant="outlined"
            :error-messages="price.errorMessage.value">
          </v-text-field>
          <v-autocomplete variant="outlined" v-model="category.value.value" :items="categories" item-value="id"
            item-title="title" label="Categorie" :error-messages="category.errorMessage.value">
            <template #append><v-btn class="btn-primary ">Categorie toevoegen</v-btn></template>
          </v-autocomplete>

          <!-- Add this after the category select -->
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

          <v-text-field v-model="imageurl.value.value" label="Afbeelding URL" variant="outlined"
            :error-messages="imageurl.errorMessage.value">
          </v-text-field>


          <v-img v-if="imageurl.value.value" class="mb-5 image-size" contain max-width="250"
            :src="imageurl.value.value"></v-img>
          <v-img v-else class="mb-5 image-size" contain max-width="250" :src="image"></v-img>





          <v-file-input variant="outlined" v-model="mainImage.value.value" :error-messages="errors" accept="image/*"
            label="Hoofdafbeelding" prepend-icon="" class="mb-5" @change="previewImage" @click:clear="clearPreviewImage"
            clearable>

            <template v-slot:prepend-inner>
              <v-icon class="mr-3"> fa-image </v-icon>
            </template>
          </v-file-input>
          <v-row>
            <v-col class="image-container" cols="2" :key="index" v-for="(galleryimage, index) in galleryImages">
              <v-hover v-slot="{ isHovering, props }">
                <v-img v-bind="props" contain class="image-size mb-5" max-width="250" :src="galleryimage">
                  <template v-if="isHovering">

                    <v-fade-transition>
                      <div class="overlay"></div>
                    </v-fade-transition>

                    <!-- Delete Button -->s
                    <v-btn icon class="delete-btn" @click="deleteImage(index)">
                      <v-icon>fa-trash-can</v-icon>
                    </v-btn>

                    <!-- Download Button -->
                    <v-btn icon class="download-btn" @click="downloadImage(galleryimage)">
                      <v-icon>fa-floppy-disk</v-icon>
                    </v-btn>
                  </template>
                </v-img>
              </v-hover>
            </v-col>
          </v-row>


          <v-file-input v-model="gallery.value.value" loader-height="5" :loading="galleryImagesLoading" multiple
            prepend-icon="" variant="outlined" accept="image/*" label="Gallerij afbeeldingen" truncate-length="15"
            @change="previewGalleryImages">
            <template v-slot:prepend-inner>
              <v-icon class="mr-3"> fa-image </v-icon>
            </template>
          </v-file-input>

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


          <v-row>
            <v-col cols="auto">
              <v-btn class="btn-primary" type="submit"><span v-if="is_trashed">Product herstellen</span><span
                  v-else>Opslaan</span></v-btn>
            </v-col>
            <v-col cols="auto">


              <v-dialog v-if="!is_trashed" v-model="confirmDeletionDialog" persistent width="auto">
                <template v-slot:activator="{ props }">
                  <v-btn v-bind="props" color="red" class="text-white" type="submit"
                    @click="confirmDeletion()">Verwijderen</v-btn>
                </template>
                <v-card>
                  <v-card-title class="text-h5">
                  </v-card-title>
                  <v-card-text>Weet je zeker dat je dit product wilt verwijderen?</v-card-text>
                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="red" @click="confirmDeletionDialog = false; deleteProduct()">
                      Ja
                    </v-btn>
                    <v-btn color="blue-darken-4"  @click="confirmDeletionDialog = false">
                      Nee
                    </v-btn>
                  </v-card-actions>
                </v-card>
              </v-dialog>

            </v-col>
          </v-row>
        </v-form>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script setup>
import { ref, onMounted  } from 'vue'
import { useForm, useField } from 'vee-validate'
import * as yup from 'yup'
import '@/languages/yup-nl_NL.js'
import { setLocale } from 'yup'
import axios from '@/services/axios'
import { useRoute } from 'vue-router'

const route = useRoute()

const debug = (val) => {
  console.log(val)
}

setLocale({
  mixed: {
    default: '${field} is niet geldig',
    required: ({ label, values }) => `${label} is een verplicht veld`,
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
    number: ({ label, values }) => `${label} moet een getal zijn`,
    positive: ({ label, values }) => `${label} moet een getal hoger dan 0 zijn`,
    min: 'moet groter dan of gelijk zijn aan ${min}',
    max: 'moet kleiner dan of gelijk zijn aan ${max}',
  },
});

const schema = yup.object().shape({
  title: yup.string().required().label('Titel'),
  quantity: yup.number().typeError((obj) => `${obj.label} moet een getal zijn`).required().positive().integer().label('Aantal'),
  // price: yup.number().typeError((obj) => `${obj.label} moet een getal zijn`).required().positive().integer().label('Prijs'),
  price: yup.string().test('is-decimal', 'Prijs is ongeldig', value => (value + "").match(/^\d+(,\d{1,2})?$/)).label('Prijs'),
  category: yup.string().required().label('Categorie'),
  imageurl: yup.string().notRequired().label('Afbeelding URL'),
  gtin: yup.number().typeError((obj) => `${obj.label} moet een getal zijn`).required().test('len', 'EAN code moet precies 13 cijfers bevatten', val => val.toString().length === 13).label('EAN code'),
  condition: yup.string().required().oneOf(['new', 'used']).label('Condition'),
  location_id: yup.number().nullable(),
  // shelf_position: yup.string().nullable().max(50)
});


const { handleSubmit, handleReset, errors } = useForm({
  validationSchema: schema
})

const is_trashed = ref('is_trashed')

const title = useField('title')
const quantity = useField('quantity')
const category = useField('category')
const gallery = useField('gallery')
const mainImage = useField('mainImage')
const gtin = useField('gtin')
gtin.value.value = parseInt(route.params.gtin)
const price = useField('price')
const imageurl = useField('imageurl')
const condition = useField('condition')
const location = useField('location_id')
// const shelfPosition = useField('shelf_position')

const isInvestment = useField('is_investment')

const purchasePrice = useField('purchase_price')
const targetPrice = useField('target_price')
const purchaseDate = useField('purchase_date')
const expectedListDate = useField('expected_list_date')
const investmentNotes = useField('investment_notes')

const categories = ref([])
const galleryImages = ref([])
const image = ref('https://portal.bntk.eu/image-placeholder.png')
const galleryImagesLoading = ref(false)
const confirmDeletionDialog = ref(false)

const conditions = [
  { title: 'New', value: 'new' },
  { title: 'Used', value: 'used' }
]

const locations = ref([])

const previewImage = (event) => {
  const file = event.target.files[0];

  image.value = URL.createObjectURL(file)
}


const previewGalleryImages = (event) => {
  let images = []
  Array.from(event.target.files).forEach(image => {
    galleryImages.value.push(URL.createObjectURL(image))
  })

}

const generateEan = async () => {
  const response = await axios.get('/api/generate-ean')
  gtin.value.value = response.data
}

const onSubmit = handleSubmit(async (values) => {
  if (values.mainImage) {
    values.mainImage = await fileToBase64(values.mainImage[0])
  }
  if (values.gallery) {
    galleryImagesLoading.value = true
    const promises = values.gallery.map(file => fileToBase64(file));
    values.gallery = await Promise.all(promises);
  }
  

  await axios.post('/api/product', values)
  galleryImagesLoading.value = false
  //show message that product is saved

  console.log('Submitted with', values);
});

const clearPreviewImage = () => {
  image.value = 'https://portal.bntk.eu/image-placeholder.png'

}
const deleteImage = (index) => {
  console.log(galleryImages.value)
  //gallery.value.value.splice(index, 1)
  galleryImages.value.splice(index, 1)
}

const loadLocations = async () => {
  try {
    const response = await axios.get('/api/stock-locations')
    locations.value = response.data
  } catch (error) {
    console.error('Error loading locations:', error)
  }
}

onMounted(async () => {
  await loadLocations()
  const product = await axios.get('/api/product/' + gtin.value.value)

  is_trashed.value = product.data.is_trashed
  title.value.value = product.data.title
  quantity.value.value = product.data.stock
  category.value.value = product.data.category_id
  image.value = product.data.main_image
  galleryImages.value = product.data.gallery_images
  imageurl.value.value = product.data.imageurl
  imageurl.value.value = product.data.imageurl

  price.value.value = parseFloat(product.data.price).toFixed(2).replace('.', ',')
  condition.value.value = product.data.condition || 'new'
  location.value.value = product.data.location_id
  // shelfPosition.value.value = product.data.shelf_position

  isInvestment.value.value        = product.data.is_investment ? true : false
  purchasePrice.value.value       = product.data.purchase_price
  targetPrice.value.value         = product.data.target_price
  purchaseDate.value.value        = product.data.purchase_date
  expectedListDate.value.value    = product.data.expected_list_date
  investmentNotes.value.value     = product.data.investment_notes

  const categorylist = await axios.get('/api/categorylist')
  categories.value = categorylist.data
})


const fileToBase64 = (file) => {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.onload = (event) => resolve(event.target.result);
    reader.onerror = (error) => reject(error);
    reader.readAsDataURL(file);
  });
}

const confirmDeletion = () => {
  confirmDeletionDialog.value = true
}

const deleteProduct = () => {
  axios.delete('/api/product/' + gtin.value.value)
}

</script>


<style scoped>
.fill-width {
  overflow-x: auto;
  flex-wrap: nowrap;
}

.image-size {
  width: 250px;
  height: 250px;
}

.image-container {
  position: relative;
}


.image {
  transition: all 0.3s ease;
}

.overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
  /* Black with opacity */
  transition: all 0.3s ease;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-to

/* .fade-leave-active in <2.1.8 */
  {
  opacity: 0;
}

.delete-btn,
.download-btn {
  position: absolute;

  visibility: hidden;
  background: white;
}

.delete-btn {
  top: 50px;
  /* adjust as needed */
  right: 10px;
  /* adjust as needed */
}

.download-btn {
  top: 10px;
  /* adjust as needed */
  right: 10px;
  /* adjust as needed */
}

.image-container:hover .delete-btn,
.image-container:hover .download-btn {
  visibility: visible;
}
</style>