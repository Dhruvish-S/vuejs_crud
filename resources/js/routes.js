import {createWebHistory,createRouter} from 'vue-router'
import Add from './components/Add.vue'


const routes =[
    {
        path:'/users',
        name:'users',
        component: () => import('../js/components/Add.vue')
    },
    {
        path:'/',
        name:'home',
        component: () => import('../js/components/Home.vue')
    },
    {
        path:'/list',
        name:'list',
        component: () => import('../js/components/List.vue')
    },
    {
        path:'/edit/:id',
        name:'edit',
        component: () => import('../js/components/Edit.vue')
    },
]


const router=createRouter({
    history: createWebHistory(),
    routes
});
export default router;
