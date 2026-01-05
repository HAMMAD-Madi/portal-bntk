<template>
    <v-container fluid>
        <v-card class="card z-index-2 h-100">
      <v-card-text class="card-body p-3">
        <v-form @submit.prevent="onSubmit">
            <v-text-field
                label="product titel"
                variant="outlined"
                name="title"
                rules="required"
                v-model="productForm.product.title"
                :error-messages="errors.product.title"
            ></v-text-field>

            <v-btn
                :loading="loading"
                type="submit"
                block
                class="btn-primary mt-2"
                text="Submit"
                ></v-btn>
                <!-- color="#2196f3"
                style="color:white" -->
        </v-form>
        </v-card-text>
        </v-card>
    </v-container>
</template>

<script setup>
    import { useRoute } from 'vue-router'
    import { ref, onMounted, onBeforeMount } from 'vue'
import axios from 'axios';
import { object, string, boolean } from 'yup';
import { useField, useForm, useFieldError, defineRule, configure  } from 'vee-validate'
import { localize } from '@vee-validate/i18n';
import nl from '@vee-validate/i18n/dist/locale/nl.json';
import { required, email, min } from '@vee-validate/rules';
defineRule('required', required);
defineRule('email', email);
defineRule('min', min);

    const route = useRoute()
    const gtin = ref()
    const product = ref({product: {title: ''}})

    const loading = ref(false)
    let productForm = ref({product: {title: ''}})

    onBeforeMount(async () => {

        gtin.value = route.params.gtin

        const response = await axios.get('/api/product/' + gtin.value)
        product.value = response.data
    })
        // productForm.value = { productForm } = useForm({
        //     validationSchema: {
        //         product: {
        //         title: {
        //             required,
        //         },
        //         },
        //     },
        //     })
        // })

        // defineRule('required', required);
        


        // const { title, handleBlur, errors } = useField('productForm.product.title')

// Define a custom validator for the title field.
// useField('productForm.product.title', {
//   validator(value) {
//     if (value.length < 3) {
//       return 'The title must be at least 3 characters long.'
//     }
//   },
// })


// async function onSubmit() {
//   await productForm.submit()

//   if (!productForm.errors.hasErrors) {
//     // Form is valid
//   }
// }
</script>


