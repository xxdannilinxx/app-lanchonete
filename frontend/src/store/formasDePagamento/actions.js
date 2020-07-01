import { app as api } from '../../boot/App'

export const actions = {
    async lista ({ commit }, dados) {
        const data = await api.service('formasdepagamento/api/lista', dados, 'GET')
        commit('SET_FORMAS', data)
        return data
    },
    async selecionar ({ commit }, dados) {
        commit('SET_FORMA_DE_PAGAMENTO', dados)
        return dados
    },
    async alterarTroco ({ commit }, dados) {
        commit('SET_TROCO', dados)
        return dados
    },
    async limpar ({ commit }) {
        commit('SET_TROCO', 0)
        commit('LIMPAR_FORMA_DE_PAGAMENTO')
        return []
    }
}
