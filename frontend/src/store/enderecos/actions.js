import { app as api } from '../../boot/App'

export const actions = {
    async lista ({ commit }, dados) {
        const data = await api.service('enderecos/api/lista', dados, 'GET')
        commit('SET_ENDERECOS', data)
        return data
    },
    async buscar ({ commit }, dados) {
        const data = await api.service('enderecos/api/lista', dados, 'GET')
        commit('SET_ENDERECO', data)
        return data
    },
    async remover ({ commit }, dados) {
        const data = await api.service('enderecos/api/remover', dados, 'DELETE')
        commit('REMOVE_ENDERECO', dados)
        return data
    },
    async alterar ({ commit }, dados) {
        const data = await api.service('enderecos/api/alterar', dados, 'PUT')
        if (dados.id) {
            commit('UPDATE_ENDERECO', dados)
        } else {
            commit('ADD_ENDERECO', data)
        }
        return data
    },
    async alterarEnderecoPadrao ({ commit }, dados) {
        commit('UPDATE_ENDERECO_PADRAO', dados)
        return dados
    }
}
