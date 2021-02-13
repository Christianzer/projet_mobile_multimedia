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
        name:'utilisateur_etudiant',
        path:'/utilisateur_etudiant',
        component:classe
    },
    {
        name:'message_sms',
        path:'/sms',
        component:classe
    },
    {
        name:'message_mail',
        path:'/mail',
        component:classe
    }


];
