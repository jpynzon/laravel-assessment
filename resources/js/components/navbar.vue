<template>
    <div class="top-nav bg-black">
        <router-link to="/admincp" class="nav-link text-right px-3 text-white">AdminCP</router-link>
    </div>
    <div class="nav-bar bg-light border-bottom">
        <div class="navbar container align-items-center">
            <div class="logo-holder me-lg-auto">
                <img id="logoImage" src="../../assets/images/logo.png" :style="logoStyle">
            </div>
            <nav class="nav-menu d-flex">
                <router-link to="/" class="nav-link p-3" :class="{ active: isActive('/') }">HOME</router-link>
                <router-link to="/order" class="nav-link p-3"
                    :class="{ active: isActive('/order') }">SERVICES</router-link>
                <router-link to="/contact" class="nav-link p-3"
                    :class="{ active: isActive('/contact') }">CONTACT</router-link>
                <router-link to="/signup" class="nav-link p-3 bg-blue text-white">JOIN NOW</router-link>
            </nav>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Navbar',
    data() {
        return {
            logoHeight: 80
        }
    },
    computed: {
        logoStyle() {
            return {
                height: this.logoHeight + 'px',
                width: 'auto',
                transition: 'height 0.3s'
            }
        }
    },
    methods: {
        isActive(path) {
            return this.$route.path === path;
        },
        handleScroll() {
            if (window.scrollY > 0) {
                this.logoHeight = 60;
            } else {
                this.logoHeight = 80;
            }
        }
    },
    mounted() {
        window.addEventListener('scroll', this.handleScroll);
    },
    unmounted() {
        window.removeEventListener('scroll', this.handleScroll);
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