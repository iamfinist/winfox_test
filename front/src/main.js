import { createApp } from 'vue/dist/vue.esm-bundler'
import './style.css'
import App from './App.vue'
import { createRouter, createWebHistory } from 'vue-router'
import SignUpForm from "./components/SignUpForm.vue";

const routes = [
    {
        path: '/signup',
        component: SignUpForm,
        meta: { title: 'Sign Up' }
    },
    {
        path: '/:pathMatch(.*)*',
        redirect: { path: "/signup" }
    },
    {
        path: '/',
        redirect: { path: "/signup" }
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

const app = createApp(App)
app.use(router)
app.mount('#app')