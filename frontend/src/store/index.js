import Vue from 'vue'
import Vuex from 'vuex'
import configuracoes from './configuracoes/'
import produtos from './produtos/'
import clientes from './clientes/'
import enderecos from './enderecos/'
import bairros from './bairros/'

Vue.use(Vuex)

export default new Vuex.Store({
    name: 'store',
    modules: {
        configuracoes,
        produtos,
        clientes,
        enderecos,
        bairros
    },
    strict: process.env.NODE_ENV !== 'production'
})
