export const actions = {
    async adicionar ({ commit }, dados) {
        commit('ADD_ITEM', dados)
        return dados
    },
    async remover ({ commit }, dados) {
        commit('REMOVE_ITEM', dados)
        return dados
    },
    async limpar ({ commit }) {
        commit('CLEAR_ITENS')
        return []
    }
}
