<template>
    <v-container fluid>
        <v-card class="card z-index-2 h-100">
            <v-card-text class="card-body p-3">
                <categories></categories>

            </v-card-text>
        </v-card>
    </v-container>
</template>

<script setup>

import { ref, onMounted, watch } from 'vue'
import axios from '@/services/axios'
import { useRoute, useRouter } from 'vue-router'
import categories from '../../components/Categories.vue'

onMounted(async () => {

})



</script>
