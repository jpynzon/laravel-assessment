<template>
  <v-container class="p-5">
    <v-card>
      <v-card-title class="fw-bold"> Registered Accounts </v-card-title>

      <v-table v-if="users.length === 0">
        <thead>
          <tr>
            <th class="text-left fw-bold">ID</th>
            <th class="text-left fw-bold">Name</th>
            <th class="text-left fw-bold">Email</th>
            <th class="text-left fw-bold">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td>{{ user.id }}</td>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>
              <i class="bi bi-pencil-square" @click="editUser(user)"></i>
              |
              <i class="bi bi-trash-fill" @click="deleteUser(user)"></i>
            </td>
          </tr>
        </tbody>
      </v-table>

      <v-alert v-else-if="!loading" type="info" class="mt-4"
        >No users found.</v-alert
      >
      <v-progress-circular
        v-if="loading"
        indeterminate
        color="primary"
      ></v-progress-circular>
      <v-alert v-if="error" type="error" class="mt-4">{{ error }}</v-alert>

      <div class="mt-4">
        <h3>Debug Info:</h3>
        <pre>{{ JSON.stringify(users, null, 2) }}</pre>
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
      users: [],
      error: null,
      loading: true,
    };
  },

  mounted() {
    this.fetchUsers();
  },

  methods: {
    async fetchUsers() {
      this.loading = true;
      this.error = null;
      try {
        const response = await axios.get("/api/users");
        console.log("Fetched users:", response.data);
        this.users = response.data;
      } catch (error) {
        console.error("Error fetching users:", error);
        this.error = "Failed to fetch users. Please try again later.";
        if (error.response && error.response.status === 401) {
          // Redirect to login page if unauthorized
          window.location.href = "/login";
        }
      } finally {
        this.loading = false;
      }
    },
    editUser(user) {
      console.log("Edit user:", user);
    },
    async deleteUser(user) {
      try {
        await axios.delete(`/api/users/${user.id}`);
        this.fetchUsers();
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
