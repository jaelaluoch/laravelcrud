import Vue from 'vue'
import VueRouter from 'vue-router'
import VueAxios from 'vue-axios';
import axios from 'axios';
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
import VueLoading from 'vuejs-loading-plugin'


Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(VueToast);
Vue.use(VueLoading)

import App from './view/App'
import Index from './pages/index'
import SignUp from './pages/signup'
import Home from './pages/home'
import Status from './pages/status'
import Task from './pages/tasks'
import MyTask from './pages/mytasks'


const router = new VueRouter({
    mode: 'history',
    routes: [{
            path: '/login',
            name: 'login',
            component: Index,
            meta: { hideNavigation: true }
        },
        {
            path: '/',
            name: 'index',
            component: Index,
            meta: { hideNavigation: true }
        },
        {
            path: '/signup',
            name: 'signup',
            component: SignUp,
            meta: { hideNavigation: true }
        },
        {
            path: '/home',
            name: 'home',
            component: Home,
        },
        {
            path: '/status',
            name: 'status',
            component: Status,
        },
        {
            path: '/tasks',
            name: 'tasks',
            component: Task,
        },
        {
            path: '/mytasks',
            name: 'mytasks',
            component: MyTask,
        },
    ],
});


const app = new Vue({
    el: '#app',
    components: { App },
    router,

});