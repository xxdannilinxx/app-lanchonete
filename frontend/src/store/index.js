import Vue from 'vue'
import Vuex from 'vuex'
import produtos from './produtos/'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        produtos
    },
    strict: process.env.NODE_ENV !== 'production'
})
