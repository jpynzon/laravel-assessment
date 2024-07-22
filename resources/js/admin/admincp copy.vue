<!-- <template>
  <v-container class="p-5">
    <v-card>
      <v-card-title class="fw-bold"> Services Offered </v-card-title>

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

      <v-alert v-else-if="!loading" type="info" class="mt-4">No users found.</v-alert>
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
import axios from "axios";

export default {
  name: "AdminCp",

  data() {
    return {
      items: [],
      error: null,
      loading: true,
    };
  },

  mounted() {
    this.fetchUsers();
  },

  methods: {
    async fetchUsers() {
      const token = localStorage.getItem('auth_token');

      if (!token) {
        console.error('No token found');
        return;
      }

      try {
        const response = await axios.get('http://127.0.0.1:8000/api/items', {
          headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
          }
        });

        console.log('Fetched users:', response); // Log entire response
        if (response.headers['content-type'].includes('application/json')) {
          this.items = response.data;
        } else {
          console.error('Unexpected response type:', response.headers['content-type']);
        }
      } catch (error) {
        console.error('Error fetching users:', error.response ? error.response.data : error.message);
        this.error = 'Failed to fetch users. Please try again later.';
      } finally {
        this.loading = false;
      }
    },

    editUser(item) {
      console.log("Edit user:", item);
    },

    async deleteUser(item) {
      try {
        await axios.delete(`http://127.0.0.1:8000/api/users/${item.id}`, { // Ensure the URL matches the route
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('authToken')}`, // Include token in header
            'Accept': 'application/json'
          }
        });
        this.fetchUsers(); // Refresh user list after deletion
      } catch (error) {
        console.error("Error deleting user:", error);
        this.error = "Failed to delete user. Please try again later.";
      }
    },
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
 -->