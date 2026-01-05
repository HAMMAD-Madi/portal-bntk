<template>
  <v-container fluid>
    <v-card class="card z-index-2 h-100">
      <v-card-text class="card-body p-3">
      <VeeForm v-slot="{ handleSubmit, values }" :validation-schema="schema" as="div">
        <form @submit="handleSubmit($event, onSubmit)">
          <!-- Title Field -->
          <Field name="title" v-slot="{ field, meta }">
            <v-text-field variant="outlined" v-bind="field" label="Titel" :error="meta.touched && meta.error"
              :error-messages="meta.error" />
          </Field>
          <ErrorMessage name="title" />

          <!-- Position Field -->
          <Field name="position" v-slot="{ field, meta }">
            <v-text-field variant="outlined" v-bind="field" label="Positie" :error="meta.touched && meta.error"
              :error-messages="meta.error" />
          </Field>
          <ErrorMessage name="position" />

          <!-- Child Category Field -->
          <Field name="childcategory" v-slot="{ field, meta }">
            <v-select variant="outlined" v-bind="field" label="Hoofdcategorie" :items="childCategories"
              :error-messages="meta.error"></v-select>
          </Field>
          <ErrorMessage name="childcategory" />

          <!-- Image Upload and Preview -->
          <Field name="image" v-slot="{ handleChange, handleBlur, meta }">
            <v-img class="mb-5 image-size" contain max-width="250" max-height="250" :src="imagePreview"></v-img>

            <v-file-input variant="outlined" @change="(e) => handleImageChange(e, handleChange)" @blur="handleBlur"
              :error="meta.touched && meta.error" :error-messages="meta.error" accept="image/*" label="Hoofdafbeelding"
              prepend-icon="" class="mb-5" clearable @click:clear="clearPreviewImage">
              <template v-slot:prepend-inner>
                <v-icon class="mr-3">fa-image</v-icon>
              </template>
            </v-file-input>
          </Field>
          <ErrorMessage name="image" />

          <!-- Position Field -->
          <Field name="image_url" v-slot="{ field, meta }">
            <v-text-field variant="outlined" v-bind="field" label="Afbeeldings URL" :error="meta.touched && meta.error"
              :error-messages="meta.error" />
          </Field>
          <ErrorMessage name="image_url" />

          <!-- Submit Button -->
          <div class="mt-5">
            <v-btn type="submit" class="btn-primary ">Submit</v-btn>
          </div>
        </form>
      </VeeForm>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script setup>
import { ref, watch, onMounted } from 'vue';
import { Form as VeeForm, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';
import axios from 'axios';
import { setLocale } from 'yup'

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

// Define schema
const schema = yup.object({
  title: yup.string().required(),
  position: yup.string().required(),
  image: yup.mixed(), // Define image
  image_url: yup.string().url(),
  childcategory: yup.string()
});


let base64Image = ref('')

const fileToBase64 = (file) => {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.onload = () => resolve(reader.result);
    reader.onerror = reject;
    reader.readAsDataURL(file);
  });
};

const childCategories = ref([])

onMounted(async () => {
  const response = await axios.get('/api/categories2/children')
  childCategories.value = response.data
})


// Image preview state
const imagePreview = ref('https://portal.bntk.eu/image-placeholder.png');

// Handle image change and preview
const handleImageChange = async (event, handleChange) => {
  const file = event.target.files[0];
  if (file) {
    imagePreview.value = URL.createObjectURL(file);
    base64Image.value = await fileToBase64(file); // Convert image to Base64
    handleChange(file); // Continue with Vee-validate's handleChange function
  }
};

// Clear preview image
const clearPreviewImage = () => {
  imagePreview.value = 'https://portal.bntk.eu/imgplaceholder.png';
  base64Image.value = '';

};

// Form submit
async function onSubmit(values) {
  console.log('Form Submitted:', values);
  values.image = base64Image.value;

  const response = await axios.post('/api/categories', { ...values })

  //alert(JSON.stringify(values, null, 2));
}
</script>