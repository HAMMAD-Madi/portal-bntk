<template>
  <div>
    <div class="add-item-form">
      <input type="text" v-model="newItem.name" placeholder="Name" />
      <input type="text" v-model="newItem.description" placeholder="Description" />
      <button @click="handleAddNewItem">Add New Item</button>
    </div>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in items" :key="item.id">
          <td>{{ item.id }}</td>
          <td>
            <input type="text" v-if="editedItemId === item.id" v-model="editedItem.name" />
            <span v-else>{{ item.name }}</span>
          </td>
          <td>
            <input type="text" v-if="editedItemId === item.id" v-model="editedItem.description" />
            <span v-else>{{ item.description }}</span>
          </td>
          <td>
            <button v-if="editedItemId === item.id" @click="handleUpdateItem(item.id)">Save</button>
            <button v-else @click="startEditing(item)">Edit</button>
            <button @click="handleDeleteItem(item.id)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
    <v-data-table-server
    v-model:items-per-page="itemsPerPage"
    :headers="headers"
    :items-length="totalItems"
    :items="serverItems"
    :loading="loading"
    :search="search"
    class="elevation-1"
    item-value="name"
    @update:options="loadItems"
  ></v-data-table-server>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted, watchEffect } from 'vue';
import { useObservable } from '@vueuse/rxjs';
import { liveQuery } from 'dexie';
import db from '@/db';

const items = ref([]);
const newItem = ref({ name: '', description: '' });
const editedItemId = ref(null);
const editedItem = reactive({ name: '', description: '' });

// to fetch all items from IndexedDB
const fetchItems = async () => {
  const allItems = await db.items.toArray();
  items.value = allItems;
  console.log('Items fetched:', allItems); // Log for debugging
};

onMounted(fetchItems); // Fetch all items on component mount

// Create a live query
const items$ = liveQuery(() => db.items.toArray());

// Use useObservable to reactively update items from the live query
const reactiveItems = useObservable(items$);

watchEffect(() => {
  if (reactiveItems.value) {
    items.value = reactiveItems.value;
    console.log('Reactive items updated:', items.value);
  }
});

// to add an item
const handleAddNewItem = async () => {
  if (newItem.value.name && newItem.value.description) {
    await db.items.add({ name: newItem.value.name, description: newItem.value.description });
    newItem.value = { name: '', description: '' }; // Reset the form
  }
};

// to start editing an item
const startEditing = (item) => {
  editedItemId.value = item.id;
  editedItem.name = item.name;
  editedItem.description = item.description;
};

// to delete an item
const handleDeleteItem = async (id) => {
  await db.items.delete(id);
};

// to update an item
const handleUpdateItem = async (id) => {
  if (editedItem.name && editedItem.description) {
    await db.items.update(id, { name: editedItem.name, description: editedItem.description });
    editedItemId.value = null;
    editedItem.name = '';
    editedItem.description = '';
  }
};
</script>

<style scoped>
table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

th {
  background-color: #f2f2f2;
}
</style>