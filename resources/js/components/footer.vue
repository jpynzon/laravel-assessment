<template>
    <footer class="footer">
        <div class="container py-3 d-flex align-items-center">
            <div class="left d-flex flex-column me-lg-auto">
                <img src="../../assets/images/logo.png" style="max-width: 150px;" class="w-100">
                <span class="text-secondary">Creativity &copy 2024 All rights reserved.
                </span>
            </div>

            <div class="right">
                <ul class="list-unstyled nav-menu d-flex">
                    <li><a href="#home" class="nav-link mx-2">Home</a></li>
                    <li><a href="#contact" class="nav-link mx-2">Contact</a></li>
                </ul>
                <ul class="list-unstyled nav-menu d-flex">
                    <li><a href="https://www.facebook.com/khunichiii/" class="nav-link mx-3"><i
                                class="bi bi-facebook"></i></a></li>
                    <li><a href="https://www.youtube.com/@Khunichi" class="nav-link mx-3"><i
                                class="bi bi-youtube"></i></a></li>
                    <li><a href="https://www.instagram.com/jpynzon/" class="nav-link mx-3"><i
                                class="bi bi-instagram"></i></a></li>
                </ul>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    name: 'Footer',
};
</script>

<style scoped>
.footer {
    width: 100%;
    height: auto;
    line-height: 60px;
    /* Vertically center the text there */
    background-color: #f5f5f5;
}
</style>
