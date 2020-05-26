import { app as api } from '../../boot/App'

export const actions = {
    async carregar ({ commit }) {
        const data = await api.service('configuracoes/api/carregar', {}, 'GET')
        commit('SET_CONFIGURACOES', data)
        return data
    }
}
