import { app as api } from '../../boot/App'

export const actions = {
    async lista ({ commit }, dados) {
        const data = await api.service('bairros/api/lista', dados, 'GET')
        commit('SET_BAIRROS', data)
        return data
    }
}
