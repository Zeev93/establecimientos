import Vue from 'vue'
import VueRouter from 'vue-router'
import VuePageTransition from 'vue-page-transition'
import InicioEstablecimientos from '../components/InicioEstablecimientos'
import MostarEstablecimiento from '../components/MostrarEstablecimiento'

const routes = [
    {
        path: '/',
        component:InicioEstablecimientos
    },
    {
        path: '/establecimiento/:id',
        name: "establecimiento",
        component: MostarEstablecimiento
    }

]

const router = new VueRouter({
    routes,
    mode: 'history'
})

Vue.use(VueRouter)
Vue.use(VuePageTransition)

export default router
