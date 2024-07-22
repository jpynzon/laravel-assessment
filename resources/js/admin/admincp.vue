<template>
  <v-container class="p-5">
    <v-card>
      <div class="navbar d-flex bg-dark">
        <v-card-title class="fw-bold text-white">Services Offered</v-card-title>
        <CreateModal v-model:dialog="showCreateModal" />
      </div>

      <v-data-table v-if="items.length > 0" :headers="headers" :items="items" item-key="id">
        <template v-slot:item.actions="{ item }">
          <v-tag class="d-flex">
            <EditModal :item="item" />
            <DeleteModal :item="item" @deleted="fetchItems" />
          </v-tag>
        </template>
      </v-data-table>

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
      headers: [
        { text: 'ID', value: 'id' },
        { text: 'Name', value: 'name' },
        { text: 'Description', value: 'description' },
        { text: 'Actions', value: 'actions' }
      ],
      selectedItem: null,
      loading: false,
      showCreateModal: false,
      error: null
    };
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
</style>
