export const mutations = {
    SET_ITEMS (state, items) {
        state.items = items.data
    },
    SET_PRODUTO (state, produto) {
        state.produto = produto
    },
    SET_OPCOES (state, opcoes) {
        state.opcoes = opcoes.data
    }
}
