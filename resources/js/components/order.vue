<template>
    <div id="order">
        <div class="container">
            <div class="product-area py-5 text-center">
                <h2 class="area-title fw-bold mb-3">Discover the Range of Our Services</h2>
                <h6 class="desc mb-5">Enhance your online presence with our comprehensive website solutions, tailored to
                    elevate your brand to new heights.</h6>

                <div class="cards d-flex flex-wrap justify-content-center">

                    <div class="card m-3">
                        <div class="left p-3">
                            <div class="icon mb-3">
                                <img src="../../assets/images/web.svg" class="" height="60px">
                            </div>
                            <div class="text-group">
                                <h5 class="title fw-bold">Web Development</h5>
                                <p class="desc">At Creativity, we specialize in crafting custom websites that combine
                                    aesthetics, functionality, and seamless user experience. Here’s what we offer:</p>
                                <ul class="offers text-start">
                                    <li class="mb-3"><b>Responsive Design:</b> <br> We create websites that adapt
                                        flawlessly to various devices—desktops, tablets, and mobile phones.
                                    </li>
                                    <li class="mb-3"><b>Front-End Development:</b> <br> Our skilled front-end developers
                                        use HTML, CSS, and JavaScript to build visually appealing interfaces.
                                    </li>
                                    <li class="mb-3"><b>Back-End Development:</b> <br> Behind every great website is a
                                        robust back end. We work with frameworks like Django, Ruby on Rails, and
                                        Node.js.
                                    </li>
                                </ul>
                                <button class="btn btn-outline-secondary rounded-5">LEARN MORE</button>
                            </div>
                        </div>
                    </div>

                    <div class="card m-3">
                        <div class="left p-3">
                            <div class="icon mb-3">
                                <img src="../../assets/images/mobile.svg" class="" height="60px">
                            </div>
                            <div class="text-group">
                                <h5 class="title fw-bold">Mobile Development</h5>
                                <p class="desc">Our mobile development team specializes in creating cutting-edge apps
                                    for both iOS and Android platforms. Here’s what we offer:</p>
                                <ul class="offers text-start">
                                    <li class="mb-3"><b>Custom App Development:</b> <br> Tailored solutions to meet your
                                        unique business needs.
                                    </li>
                                    <li class="mb-3"><b>User-Centric Design:</b> <br> Intuitive interfaces that enhance
                                        user experience.
                                    </li>
                                    <li class="mb-3"><b>Performance Optimization:</b> <br> Efficient code, smooth
                                        animations, and fast load times.
                                    </li>
                                    <li class="mb-3"><b>App Store Deployment:</b> <br> Assistance with app submission
                                        and approval.
                                    </li>
                                </ul>
                                <button class="btn btn-outline-secondary rounded-5">LEARN MORE</button>
                            </div>
                        </div>
                    </div>

                    <div class="card m-3">
                        <div class="left p-3">
                            <div class="icon mb-3">
                                <img src="../../assets/images/project.svg" class="" height="60px">
                            </div>
                            <div class="text-group">
                                <h5 class="title fw-bold">Project Management</h5>
                                <p class="desc">Successful projects require effective management. Our project management
                                    team ensures seamless execution and timely delivery. Here’s how we do it:</p>
                                <ul class="offers text-start">
                                    <li class="mb-3"><b>Initiation Phase:</b> <br> Define project goals, stakeholders,
                                        and scope.
                                    </li>
                                    <li class="mb-3"><b>Planning Phase:</b> <br> Create a detailed project plan.
                                    </li>
                                    <li class="mb-3"><b>Execution Phase:</b> <br> Oversee team efforts and task
                                        completion.
                                    </li>
                                    <li class="mb-3"><b>Closing Phase:</b> <br> Verify completion of requested outcomes.
                                    </li>
                                </ul>
                                <button class="btn btn-outline-secondary rounded-5">LEARN MORE</button>
                            </div>
                        </div>
                    </div>

                    <div v-for="item in items" :key="item.id" class="card m-3">
                        <div class="left p-3">
                            <div class="icon mb-3">
                                <img src="../../assets/images/project.svg" class="" height="60px">
                            </div>
                            <div class="text-group">
                                <h5 class="title fw-bold">{{ item.name }}</h5>
                                <p class="desc">{{ item.description }}</p>
                                <button class="btn btn-outline-secondary rounded-5">LEARN MORE</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Order',

    data() {
        return {
            items: [],
            loading: false,
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
    },

    mounted() {
        this.fetchItems();
    }
};
</script>

<style scoped>
@media only screen and (max-width: 900px) {
    .card {
        width: 100% !important;
        min-width: 300px !important;
    }
}

.card {
    width: 30%;
    min-width: 200px;
}

.icon img {
    margin-right: 3px;
}
</style>
