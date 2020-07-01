import { app as api } from '../../boot/App'

export const actions = {
    async buscar ({ commit }, dados) {
        const data = await api.service('cuponsdedesconto/api/lista', dados, 'GET')
        commit('SET_CUPONS', data)
        return data
    },
    async selecionar ({ commit }, dados) {
        commit('SET_CUPOM', dados)
        return dados
    },
    async remover ({ commit }) {
        commit('REMOVE_CUPOM')
        return {}
    }
}
