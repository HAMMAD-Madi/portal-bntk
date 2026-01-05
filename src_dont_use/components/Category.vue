<template>
  <v-container fluid>
    <v-card class="card z-index-2 h-100">
      <v-card-text class="card-body p-3">
        <div v-if="category">
          <h2>{{ category.title }}</h2>
          <p class="mt-5">Product aantal: {{ category.product_count }}</p>
          <v-btn v-if="category.products.length" class="my-5 btn-primary" @click="navigateToProducts()">Toon
            producten</v-btn>
          <div v-if="category.children.length">
            <h3 class="mb-5">Subcategorieën</h3>
            <div class="category-grid">
              <div v-for="child in category.children" :key="child.id" class="category-item"
                @click="goToCategory(child.id)">
                <img :src="child.image" alt="Category Image" />
                <h3>{{ child.title }} ({{ child.product_count }})</h3>
              </div>
            </div>
          </div>
        </div>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import axios from 'axios';
import { useRoute, useRouter } from 'vue-router';

const route = useRoute();
const router = useRouter();
const category = ref(null);

const fetchCategory = async (id) => {
  try {
    const response = await axios.get(`/api/categories/${route.params.id}`);
    category.value = response.data;
  } catch (error) {
    console.error('Error fetching category:', error);
  }
};

watch(route, (to) => {
  fetchCategory(to.params.id);
}, { flush: 'pre', immediate: true, deep: true })

const goToCategory = (categoryId) => {
  router.push(`/categorieen/${categoryId}`);
};

const navigateToProducts = () => {
  router.push({ path: '/voorraad', query: { category: category.value.id } })

}

onMounted(() => {
  //fetchCategory(route.params.id);
});
</script>

<style>
.category-grid {
  display: flex;
  flex-wrap: wrap;
  gap: 16px;
}

.category-item {
  cursor: pointer;
  text-align: center;
}

.category-item img {
  width: 200px;
  height: 200px;
}
</style>