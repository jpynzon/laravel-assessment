<template>
  <v-container class="d-flex justify-center p-5">
    <v-card class="w-50">
      <v-card-title tag="h1" class="fw-bold">Login</v-card-title>
      <v-card-text>
        <v-form @submit.prevent="login">
          <v-text-field v-model="email" label="Email" required></v-text-field>
          <v-text-field v-model="password" label="Password" type="password" required></v-text-field>
          <p> Don't Have an Account? <router-link to="/signup">Create an Account</router-link> </p>
          <v-btn color="primary" type="submit">Login</v-btn>
        </v-form>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script>
import axios from 'axios';
import { setAuth } from '../auth';

export default {
  name: 'Login',
  data() {
    return {
      email: '',
      password: '',
    };
  },
  methods: {
    async login() {
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/login', {
          email: this.email,
          password: this.password
        });

        console.log('Login response:', response.data);

        if (response.data.token) {
          localStorage.setItem('auth_token', response.data.token);
          setAuth(response.data.user, response.data.token);
          this.$router.push('/');
        } else {
          console.error('No token received');
        }
      } catch (error) {
        console.error('Login failed:', error.response ? error.response.data : error.message);
        console.error('Response headers:', error.response ? error.response.headers : 'No response headers');
        console.error('Response status:', error.response ? error.response.status : 'No response status');
      }
    }
  }
};
</script>

<style scoped>
.login {
  padding: 20px;
}
</style>