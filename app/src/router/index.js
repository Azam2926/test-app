import {createRouter, createWebHistory} from 'vue-router'
import Main from '../layouts/Main.vue'
import Auth from "../layouts/Auth.vue";
import Home from '../views/Home.vue'
import Test from '../views/Test.vue'
import Login from "../views/Login.vue";
import Registration from "../views/Registration.vue";
import authService from "../service/auth.service";

const routes = [
    {
        path: '/',
        redirect: '/home',
        component: Main,
        meta: {requiresAuth: true},

        children: [
            {
                path: 'home',
                name: 'home',
                component: Home,
            },
            {
                path: 'test',
                component: Test,
            },
        ],
    },
    {
        path: '/auth',
        component: Auth,
        children: [
            {
                path: 'register',
                component: Registration
            },
            {
                path: 'login',
                name: 'login',
                component: Login
            }
        ]
    },
    {
        path: '/login',
        redirect: '/auth/login'
    },
    {
        path: '/register',
        redirect: '/auth/register'
    },
    { path: '/:pathMatch(.*)*', name: 'NotFound', redirect: {name: 'home'} },

]

const router = createRouter({
    history: createWebHistory(),
    routes,
})


router.beforeEach((to, from) => {
    // instead of having to check every route record with
    // to.matched.some(record => record.meta.requiresAuth)
    if (to.meta.requiresAuth && !authService.isLoggedIn()) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        return {
            path: '/login',
            // save the location we were at to come back later
            query: {redirect: to.fullPath},
        }
    }
})

export default router