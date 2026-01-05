<template>
    <div ref="el" class="category-item nested-sortable">
      <div>
        {{ category.name }}

        <div class="category-children">
        <CategoryItem
          v-for="child in category.children"
          :key="child.id"
          :category="child"
          @move="moveChild"
        />
      </div>
      </div>

    </div>
  </template>
  
  <script setup>
  import { ref, onMounted, watch } from 'vue';
  import Sortable from 'sortablejs';
  import { defineEmits, defineProps } from 'vue';
  
  // Define props and emits
  const props = defineProps({
    category: {
      type: Object,
      required: true,
    },
  });
  const emit = defineEmits(['move']);
  
  const el = ref(null);
  
  // Move child handler
  const moveChild = (event) => {
    emit('move', event);
  };
  
  // Helper function to move array elements
  function moveArrayElement(array, fromIndex, toIndex) {
    const element = array[fromIndex];
    array.splice(fromIndex, 1);
    array.splice(toIndex, 0, element);
  }
  
  // Register the recursive component
  import CategoryItem from './CategoryItem.vue';
  
  onMounted(() => {
    Sortable.create(el.value, {
      group: 'nested',
      animation: 150,
      fallbackOnBody: true,
      swapThreshold: 0.65,
      onEnd(event) {
        const { oldIndex, newIndex } = event;
        moveArrayElement(props.category.children, oldIndex, newIndex);
        emit('move', { category: props.category, oldIndex, newIndex });
      },
    });
  });
  </script>
  
  <style scoped>
  .category-item {
    border: 1px solid #ccc;
    margin: 5px;
    padding: 5px;
  }
  
  .category-header {
    font-weight: bold;
  }
  
  .category-children {
    margin-left: 20px;
  }
  </style>