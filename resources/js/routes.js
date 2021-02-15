import admin from './components/admin/index.vue'
import classe from './components/admin/classe/index.vue'
import etudiant from './components/admin/etudiant/index'
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
    },
    {
        name:'etudiant',
        path:'/etudiant',
        component:etudiant
    },
    {
        name:'message',
        path:'/message',
        component:classe
    }


];
