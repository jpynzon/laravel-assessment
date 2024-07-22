<template>
  <div>
    <div v-if="isLoggedIn" class="top-nav navbar d-flex p-3 bg-black">
      <v-text>Welcome, {{ user && user.name ? user.name : 'User' }}</v-text>
      <router-link to="/admincp" class="nav-link text-right px-3 text-white">AdminCP</router-link>
    </div>
    <div class="nav-bar bg-light border-bottom">
      <div class="navbar container align-items-center">
        <div class="logo-holder me-lg-auto">
          <img id="logoImage" src="../../assets/images/logo.png" :style="logoStyle">
        </div>
        <nav class="nav-menu d-flex">
          <router-link to="/" class="nav-link p-3" :class="{ active: isActive('/') }">HOME</router-link>
          <router-link to="/order" class="nav-link p-3" :class="{ active: isActive('/order') }">SERVICES</router-link>
          <router-link to="/contact" class="nav-link p-3"
            :class="{ active: isActive('/contact') }">CONTACT</router-link>
          <router-link v-if="!isLoggedIn" to="/signup" class="nav-link p-3 bg-blue text-white">JOIN NOW</router-link>
          <a v-else @click.prevent="logout" class="nav-link p-3 bg-blue text-white">LOG OUT</a>
        </nav>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { ref, onMounted, onBeforeUnmount } from 'vue';
import { isLoggedIn, user, logout as authLogout } from '../auth';

export default {
  name: 'Navbar',

  setup() {
    const logoHeight = ref(80);

    const logoStyle = {
      height: `${logoHeight.value}px`,
      width: 'auto',
      transition: 'height 0.3s'
    };

    const isActive = (path) => window.location.pathname === path;

    const handleScroll = () => {
      logoHeight.value = window.scrollY > 0 ? 60 : 80;
    };

    const checkAuthStatus = async () => {
      const authToken = localStorage.getItem('authToken');
      isLoggedIn.value = !!authToken;

      if (isLoggedIn.value) {
        try {
          const response = await axios.get('/api/user', {
            headers: {
              'Authorization': `Bearer ${authToken}`,
              'Accept': 'application/json'
            }
          });
          user.value = response.data;
        } catch (error) {
          console.error("Failed to fetch user data:", error.response?.data || error.message);
          isLoggedIn.value = false;
          localStorage.removeItem('authToken');
        }
      }
    };

    onMounted(() => {
      checkAuthStatus();
      window.addEventListener('scroll', handleScroll);
    });

    onBeforeUnmount(() => {
      window.removeEventListener('scroll', handleScroll);
    });

    return {
      logoStyle,
      isActive,
      checkAuthStatus,
      logout: authLogout,
      isLoggedIn,
      user
    };
  }
};
</script>


<style scoped>
.nav-bar {
  position: sticky;
  top: 0;
  z-index: 1000;
}

.active {
  font-weight: bold;
}

.nav-link:hover {
  background-color: #9EDDFF !important;
}
</style>