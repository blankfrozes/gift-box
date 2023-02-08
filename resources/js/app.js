import { createApp } from "vue";
import App from "./App.vue";
import router from './router/index';
import VueTransitions from '@morev/vue-transitions';
import '@morev/vue-transitions/styles';

createApp(App)
    .use(router)
    .use(VueTransitions)
    .mount("#app");
