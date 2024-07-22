<template>
  <v-container class="p-5">
    <v-card>
      <div class="navbar d-flex bg-dark">
        <v-card-title class="fw-bold text-white"> Services Offered </v-card-title>
        <ItemModal v-model:dialog="showItemModal" />
      </div>

      <v-table v-if="items.length === 0">
        <thead>
          <tr>
            <th class="text-left fw-bold">ID</th>
            <th class="text-left fw-bold">Name</th>
            <th class="text-left fw-bold">Description</th>
            <th class="text-left fw-bold">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in items" :key="item.id">
            <td>{{ item.id }}</td>
            <td>{{ item.name }}</td>
            <td>{{ item.description }}</td>
            <td>
              <i class="bi bi-pencil-square" @click="editUser(item)"></i>
              |
              <i class="bi bi-trash-fill" @click="deleteUser(item)"></i>
            </td>
          </tr>
        </tbody>
      </v-table>

      <v-alert v-else-if="!loading" type="info" class="mt-4">No items found.</v-alert>
      <v-progress-circular v-if="loading" indeterminate color="primary"></v-progress-circular>
      <v-alert v-if="error" type="error" class="mt-4">{{ error }}</v-alert>

      <div class="mt-4">
        <h3>Debug Info:</h3>
        <pre>{{ JSON.stringify(items, null, 2) }}</pre>
      </div>
    </v-card>
  </v-container>
</template>

<script>
import axios from 'axios';
import ItemModal from './modal.vue';

export default {
  name: 'AdminCp',
  components: {
    ItemModal,
  },

  data() {
    return {
      items: [], // Array to hold fetched data
      loading: true, // Loading state
      error: null, // Error state
      showItemModal: false, // Modal visibility
    };
  },

  methods: {
    openModal() {
      this.showItemModal = true;
    },
    closeModal() {
      this.showItemModal = false;
    },

    async fetchData() {
      this.loading = true;
      this.error = null;

      try {
        const response = await axios.get('/api/items');
        this.items = response.data;
      } catch (err) {
        console.error('Error fetching data:', err);
        this.error = 'An error occurred while fetching data.';
      } finally {
        this.loading = false;
      }
    },

    editItem(item) {
      console.log('Edit item:', item);
    },

    deleteItem(item) {
      console.log('Delete item:', item);
    },
  },

  created() {
    this.fetchData();
  },
};
</script>




<style>
.bi-pencil-square {
  font-size: 20px;
  color: #6499e9;
  cursor: pointer;
}

.bi-trash-fill {
  font-size: 20px;
  color: rgb(255, 55, 55);
  cursor: pointer;
}
</style>
