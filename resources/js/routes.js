import admin from './components/admin/index.vue'
import classe from './components/admin/classe/index.vue'
import etudiant from './components/admin/etudiant/index.vue'
import message_etudiant from './components/admin/message_et/index.vue'
import message_classe from './components/admin/message_classe/index.vue'
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
        name:'message_etudiant',
        path:'/message_etudiant',
        component:message_etudiant
    },
    {
        name:'message_classe',
        path:'/message_classe',
        component:message_classe
    }


];
