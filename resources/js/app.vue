<template>
    <div id="app">
        <Navbar />
        <router-view />
        <Footer />
    </div>
</template>

<script>
import Navbar from './components/navbar.vue';
import Footer from './components/footer.vue';

export default {
    name: 'App',
    components: {
        Navbar,
        Footer,
    },
};
</script>

<style>
/* Global styles if needed */
body {
    margin: 0;
    padding: 0;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
}
</style>
