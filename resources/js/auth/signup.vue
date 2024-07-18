<template>
    <v-container class="d-flex justify-center p-5">
      <v-card class="w-50">
        <v-card-title tag="h1" class="fw-bold">Sign Up</v-card-title>
        <v-card-text>
          <v-form @submit.prevent="signUp">
            <v-text-field v-model="name" label="Name" required></v-text-field>
            <v-text-field v-model="email" label="Email" required></v-text-field>
            <v-text-field v-model="password" label="Password" type="password" required></v-text-field>
            <v-text-field v-model="password_confirmation" label="Confirm Password" type="password" required></v-text-field>
  
            <p> Already have an account? <router-link to="/login">Login</router-link> </p>
  
            <v-btn color="primary" type="submit">Sign Up</v-btn>
          </v-form>
        </v-card-text>
      </v-card>
    </v-container>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'SignUp',
  
    data() {
      return {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
      };
    },
  
    methods: {
      signUp() {
        console.log('Sign Up method called');
        console.log('Name:', this.name);
        console.log('Email:', this.email);
        console.log('Password:', this.password);
        console.log('Confirm Password:', this.password_confirmation);
  
        axios.post('http://127.0.0.1:8000/register', {
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation: this.password_confirmation
        }).then(response => {
          console.log('Signed up successfully', response);
          // Display alert and redirect to login page
          alert('Account created successfully! Please log in.');
          this.$router.push('/login');
        }).catch(error => {
          console.error('Sign-up error', error.response.data);
        });
      }
    }
  };
  </script>
  
  <style scoped>
  .sign-up {
    padding: 20px;
  }
  </style>
  