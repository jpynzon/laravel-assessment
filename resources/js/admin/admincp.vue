<template>
  <v-container class="p-5">
    <v-card>
      <div class="navbar d-flex bg-dark">
        <v-card-title class="fw-bold text-white">Services Offered</v-card-title>
        <CreateModal v-model:dialog="showCreateModal" />
      </div>

      <v-card-text v-if="items.length > 0" item-key="id">
        <table class="simple-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Description</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in paginatedItems" :key="item.id">
              <td>{{ item.id }}</td>
              <td>{{ item.name }}</td>
              <td>{{ item.description }}</td>
              <td class="d-flex flex-wrap">
                <EditModal :item="item" />
                <DeleteModal :item="item" @deleted="fetchItems" />
              </td>
            </tr>
          </tbody>
        </table>

        <div class="pagination mt-5 justify-center">
          <button @click="prevPage" :disabled="currentPage === 1">←</button>
          <button v-for="page in totalPages" :key="page" @click="changePage(page)"
            :class="{ 'active': currentPage === page }">
            {{ page }}
          </button>
          <button @click="nextPage" :disabled="currentPage === totalPages">→</button>
        </div>

      </v-card-text>

      <v-alert v-else-if="!loading" type="info" class="mt-4">No items found.</v-alert>
      <v-progress-circular v-if="loading" indeterminate color="primary"></v-progress-circular>
      <v-alert v-if="error" type="error" class="mt-4">{{ error }}</v-alert>
    </v-card>

    <!-- Include the EditModal component -->
    <edit-modal v-if="selectedItem" :item="selectedItem" @update="fetchItems" ref="editModal" />
  </v-container>
</template>

<script>
import axios from 'axios';
import EditModal from './modals/editModal.vue';
import DeleteModal from './modals/deleteModal.vue';
import CreateModal from './modals/createModal.vue';

export default {
  components: {
    EditModal,
    CreateModal,
    DeleteModal
  },

  data() {
    return {
      items: [],
      selectedItem: null,
      loading: false,
      showCreateModal: false,
      error: null,
      currentPage: 1,
      itemsPerPage: 5,
    };
  },

  computed: {
    totalPages() {
      return Math.ceil(this.items.length / this.itemsPerPage);
    },
    paginatedItems() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      const end = start + this.itemsPerPage;
      return this.items.slice(start, end);
    }
  },

  methods: {
    async fetchItems() {
      this.loading = true;
      try {
        const response = await axios.get('/items');
        this.items = response.data;
      } catch (error) {
        this.error = 'Error fetching items';
        console.error('Error fetching items:', error);
      } finally {
        this.loading = false;
      }
    },

    openCreateModal() {
      this.$refs.createModal.openDialog();
    },

    editItem(item) {
      this.selectedItem = item;
      this.$refs.editModal.openDialog();
    },

    changePage(page) {
      this.currentPage = page;
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage++;
      }
    }
  },

  created() {
    this.fetchItems();
  }
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

.simple-table {
  width: 100%;
  border-collapse: collapse;
}

.simple-table th,
.simple-table td {
  padding: 8px;
}

.simple-table th {
  background-color: #f2f2f2;
  text-align: left;
  border-radius: 5px;
}

.pagination button {
  margin: 0 5px;
  padding: 5px 10px;
  border: none;
  border-radius: 5px;
  background-color: #ddd;
  cursor: pointer;
}

.pagination button.active {
  background-color: #4caf50;
  color: white;
}

.pagination button:disabled {
  background-color: #eee;
  cursor: not-allowed;
}

.flash-message {
  background-color: #4caf50;
  color: white;
  padding: 15px;
  position: fixed;
  top: 20px;
  right: 20px;
  z-index: 1000;
  border-radius: 5px;
}
</style>
