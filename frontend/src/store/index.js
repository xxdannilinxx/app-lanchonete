import Vue from 'vue'
import Vuex from 'vuex'
import configuracoes from './configuracoes/'
import produtos from './produtos/'
import clientes from './clientes/'

Vue.use(Vuex)

export default new Vuex.Store({
    name: 'store',
    modules: {
        configuracoes,
        produtos,
        clientes
    },
    strict: process.env.NODE_ENV !== 'production',
    state: {
        loading: false
    },
    getters: {
        loading: state => state.loading
    },
    actions: {
        setLoading ({ commit }, status) {
            commit('SET_LOADING', status)
        }
    },
    mutations: {
        SET_LOADING (state, status) {
            state.loading = status
        }
    }
})
