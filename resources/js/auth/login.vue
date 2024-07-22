<template>
  <v-container class="d-flex justify-center p-5">
    <v-card class="w-50">
      <v-card-title tag="h1" class="fw-bold">Login</v-card-title>
      <v-card-text>
        <v-form @submit.prevent="login">
          <v-text-field v-model="email" label="Email" :rules="[rules.required]" required></v-text-field>
          <v-text-field v-model="password" label="Password" :rules="[rules.required]" type="password"
            required></v-text-field>
          <p> Don't Have an Account? <router-link to="/signup">Create an Account</router-link> </p>
          <v-btn color="primary" type="submit">Login</v-btn>
        </v-form>
      </v-card-text>
    </v-card>
  </v-container>

  <div v-if="flashVisible" class="flash-message">{{ flashMessage }}</div>
</template>

<script>
import axios from 'axios';
import { setAuth } from '../auth';

export default {
  name: 'Login',

  data() {
    return {
      flashMessage: '',
      flashVisible: false,
      email: '',
      password: '',
      rules: {
        required: value => !!value || 'Required.',
      },
    };
  },

  methods: {
    async login() {
      try {
        const { data } = await axios.post('http://127.0.0.1:8000/api/login', {
          email: this.email,
          password: this.password
        });

        if (data.token) {
          this.handleSuccessfulLogin(data);
        } else {
          this.handleLoginFailure('No token received');
        }
      } catch (error) {
        this.handleLoginFailure(error);
      }
    },

    handleSuccessfulLogin(data) {
      localStorage.setItem('auth_token', data.token);
      setAuth(data.user, data.token);
      this.redirectHome();
    },

    handleLoginFailure(error) {
      this.flashMessage = 'Login failed. Invalid Credentials';
      this.flashVisible = true;
      this.hideFlashMessage();
      console.error('Login failed:', error.response?.data || error.message);
      console.error('Response headers:', error.response?.headers || 'No response headers');
      console.error('Response status:', error.response?.status || 'No response status');
    },

    hideFlashMessage() {
      setTimeout(() => {
        this.flashVisible = false;
      }, 3000);
    },

    redirectHome() {
      window.location.href = '/';
    }
  }
};
</script>


<style scoped>
.login {
  padding: 20px;
}
</style>