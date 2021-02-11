import admin from './components/admin/index.vue'
import classe from './components/admin/classe/index.vue'
export const routes = [
    {
        name:'home',
        path:'/',
        component:admin
    },
    {
        name:'classe',
        path:'/classe',
        component:classe
    }


];
