import { createRouter, createWebHistory} from 'vue-router';
import Home from '../pages/Home.vue';
import PageNotFound from '../pages/404.vue';
// import About from '../pages/About.vue';
const routes = [
    {
        path: "/",
        name: "home",
        component: Home
    },
    {
        path: "/:pathMatch(.*)*",
        name: "not found",
        component: PageNotFound
    },
];

const router = createRouter({
    history: createWebHistory("/"),
    routes
});

export default router;
