import Vue from 'vue';
import VueRouter from 'vue-router';

import Register from './components/user/Register.vue';
import Login from './components/user/Login.vue';
import Dashboard from "./components/user/Dashboard";
import Form from "./components/Bank/Form";
import Show from "./components/Bank/Show";

Vue.use(VueRouter);

const router = new VueRouter({
    routes : [
        {
            path:'/login',
            component: Login
        },
        {
            path:'/register',
            component: Register
        },
        {
            path:'/dashboard',
            component: Dashboard
        },

        {
            path:'/edit/:id',
            component: Form
        },

        {
            path:'/show',
            component: Show
        },

        {
            path:'/create',
            component: Form
        },


    ]
});

export default router;