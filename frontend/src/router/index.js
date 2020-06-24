import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../store'
import routes from './routes'

Vue.use(VueRouter)

export default function (/* { store, ssrContext } */) {
  const Router = new VueRouter({
    scrollBehavior: () => ({ x: 0, y: 0 }),
    routes,
    mode: process.env.VUE_ROUTER_MODE,
    base: process.env.VUE_ROUTER_BASE
  })

  Router.beforeEach((to, from, next) => {
    var autenticado = store.getters['clientes/autenticado']
    if (to.name !== 'entrar' && !autenticado) {
      next({
        path: '/entrar'
      })
    } else {
      next()
    }
  })

  return Router
}
