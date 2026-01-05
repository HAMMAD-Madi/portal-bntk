<template>
        <v-container fluid>
            <v-row>
                <v-col cols="4">
            <v-form @submit.prevent="onSubmit">
                <v-text-field
                    :error-messages="title.errorMessage.value"
                    variant="outlined" 
                    v-model="title.value.value"
                    label="Naam">
                </v-text-field>

                        
                <v-img
                class="mb-5 image-size"
                contain
                max-width="250"
                :src="image"></v-img>

                <v-file-input

                variant="outlined"
                v-model="mainImage.value.value"
                :error-messages="errors"
                accept="image/*"
                label="Hoofdafbeelding"
                prepend-icon=""
                class="mb-5"
                @change="previewImage"
                @click:clear="clearPreviewImage"
                clearable
                >

                <template v-slot:prepend-inner>        
                <v-icon class="mr-3">fa-image</v-icon> 
                </template>
                </v-file-input>
                <v-btn class="btn-primary" type="submit">Opslaan</v-btn>
            </v-form>
            </v-col>
            <v-col cols="8">
                <div ref="rootEl" class="category-list nested-sortable">

                <CategoryItem
      v-for="category in categories"
      :key="category.id"
      :category="category"
      @move="handleMove"
    /></div>
                    <!-- <div v-for="category in categories" :key="category.id"><div>{{ category.name }}</div></div> -->
            </v-col>
        </v-row>
        </v-container>
    </template>
    
<script setup>
    
    import { ref, onMounted, watch  } from 'vue'
    import axios from '@/services/axios'
    import { useForm, useField } from 'vee-validate'
    import * as yup from 'yup'
    import '@/languages/yup-nl_NL.js'
    import { setLocale } from 'yup'
    import CategoryItem from '@/components/CategoryItem.vue';


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
    });


    const mainImage = useField('mainImage')
    const title = useField('title')
    const categories = ref([])
    const image = ref('https://portal.bntk.eu/imgplaceholder.png')
    const rootEl = ref(null);

const handleMove = (event) => {
  const { category, oldIndex, newIndex } = event;
  console.log(`Moved ${category.name} from ${oldIndex} to ${newIndex}`);
};

// Helper function to move array elements
function moveArrayElement(array, fromIndex, toIndex) {
  const element = array[fromIndex];
  array.splice(fromIndex, 1);
  array.splice(toIndex, 0, element);
}



    const { handleSubmit, handleReset, errors } = useForm({
        validationSchema: schema
    })


    const previewImage = (event) => {
        const file = event.target.files[0];

        image.value = URL.createObjectURL(file)
    }

    const clearPreviewImage = () => {
        image.value = 'https://portal.bntk.eu/imgplaceholder.png'
    }

    onMounted(async () => {
        const response = await axios.get('/api/getcategories')
        categories.value = response.data
        const nestedSortables = rootEl.value.querySelectorAll('.nested-sortable');

        nestedSortables.forEach((sortableElement) => {
    new Sortable(sortableElement, {
      group: 'nested',
      animation: 150,
      fallbackOnBody: true,
      swapThreshold: 0.65,
    });
  });

  new Sortable(rootEl.value, {
    group: 'nested',
    animation: 150,
    fallbackOnBody: true,
    swapThreshold: 0.65,
    onEnd(event) {
      const { oldIndex, newIndex } = event;
      moveArrayElement(categories.value, oldIndex, newIndex);
      handleMove({ category: categories.value[newIndex], oldIndex, newIndex });
    },
  })
    })

    const onSubmit = handleSubmit(async (values) => {
        console.log('test123');
        if(values.mainImage) {
            values.mainImage = await fileToBase64(values.mainImage[0])
        }

        await axios.post('/api/categories', values)
        //galleryImagesLoading.value = false

        //console.log('Submitted with', values);
    });

    const fileToBase64 = (file) => {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onload = (event) => resolve(event.target.result);
            reader.onerror = (error) => reject(error);
            reader.readAsDataURL(file);
        });
    }

    
</script>

