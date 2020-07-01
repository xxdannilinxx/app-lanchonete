import { app as api } from '../../boot/App'

export const actions = {
    async lista ({ commit }, dados) {
        const data = await api.service('pedidos/api/lista', dados, 'GET')
        commit('SET_PEDIDOS', data)
        return data
    },
    async adicionar ({ commit, dispatch }, dados) {
        const data = await api.service('pedidos/api/adicionar', dados, 'POST')
        dispatch('lista')
        return data
    }
}
