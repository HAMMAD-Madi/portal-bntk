<template>
        <v-container fluid>
            <v-text-field
            v-model="search"
            prepend-inner-icon="fas fa-magnifying-glass"
            label="Zoeken"
            single-line
            variant="outlined"
            hide-details
            class="mb-5"
            clearable
          ></v-text-field>
            <div></div>
            <v-data-iterator :search="search" :page="page" :items-per-page="itemsPerPage" :items="categories">
                <template v-slot:default="{ items }">
                    <v-row
                        align="start"
                    >                
                    <v-col
                    cols="12"
                    md="5"
                    lg="3"
                    xl="3"
                    v-for="category in items"
                    :key="category.id"
                    >
                    <v-card  @click="loadCategory(category.raw)">
                        <v-img
                        height="100"
                        :src="`https://portal.bntk.eu/storage${category.raw.image_url}`"
                        class="text-white"
                        ></v-img>
                        <v-card-title>{{ category.raw.name }} ({{ category.raw.products.length }})</v-card-title>
                        <v-card-text>
  
                        </v-card-text>
                    </v-card>
    
                    
                </v-col>
                    </v-row>
                </template>
            </v-data-iterator>
            
            <div class="text-center">
        <!-- <v-pagination
          v-model="page"
          :length="totalItems"
          :total-visible="7"
        ></v-pagination> -->
      </div>
    
    
        </v-container>
    </template>
    
<script setup>
    
    import { ref, onMounted, watch  } from 'vue'
    import axios from '@/services/axios'
    import { useRoute, useRouter } from 'vue-router'

    const route = useRoute()
    const router = useRouter()

    const id = ref(null)
    id.value = route.params.id


    const categories = ref([])
    const page = ref(1)
    const search = ref(null)
    const itemsPerPage = ref(10000)


    watch(route, async (to, from)  => {
        if(!to.params.id) {
            const response = await axios.get('/api/categories')
            categories.value = response.data
        } else {
            const response = await axios.get('/api/categories', { params: {id: to.params.id}})
            categories.value = response.data
        }
    });

    onMounted(async () => {
        let response = null
        if(id.value) {
            response = await axios.get('/api/categories', { params: {id: id.value}})

        } else {
            response = await axios.get('/api/categories')

        }
        categories.value = response.data
    })


    const loadCategory = async (category) => {

        if(category.products.length > 0) {
            router.push({ name: 'InventoryIndex', query: {category: category.id}});

            return
        } 
        router.push({ name: 'inventory-category', params: { id: category.id, slug: titleToSlug(category.name) } });

        const response = await axios.get('/api/categories', { params: {id: category.id}})
        categories.value = response.data
    }
    

    const titleToSlug = (title) => {
        return title
            .toLowerCase()
            .replace(/\s+/g, '-')
            .replace(/[^\w\-]+/g, '')
            .replace(/\-\-+/g, '-');
    }
    
</script>

