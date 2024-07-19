import { createApp } from 'vue';
import App from './app.vue';
import router from './router';
import axios from 'axios';

//vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

axios.defaults.withCredentials = true;
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const vuetify = createVuetify({
    components,
    directives,
})

const app = createApp(App);
app.use(vuetify);
app.use(router);
app.mount('#app');
