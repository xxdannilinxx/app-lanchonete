import { app as api } from '../../boot/App'

export const actions = {
    async lista ({ commit }, dados) {
        const data = await api.service('produtos/api/lista', dados, 'GET')
        commit('SET_ITEMS', data)
        return data
    }
}
