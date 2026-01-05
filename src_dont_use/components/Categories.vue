<template>
    <div class="category-grid">
      <div 
        v-for="category in categories" 
        :key="category.id" 
        class="category-item"
        @click="goToCategory(category.id)">
        <img :src="category.image || category.image_url || 'https://portal.bntk.eu/image-placeholder.png'" alt="Category Image" />
        <h3>{{ category.title }} ({{ category.product_count }})</h3>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import { useRouter } from 'vue-router';
  
  const categories = ref([]);
  const router = useRouter();
  
  const fetchCategories = async () => {
    try {
      const response = await axios.get('/api/categories');
      categories.value = response.data;
    } catch (error) {
      console.error('Error fetching categories:', error);
    }
  };
  
  const goToCategory = (categoryId) => {
    router.push(`/categorieen/${categoryId}`);
  };
  
  onMounted(() => {
    fetchCategories();
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