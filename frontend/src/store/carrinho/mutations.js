export const mutations = {
    SET_ITENS (state, dados) {
        state.itens = dados
        localStorage.setItem('carrinho', JSON.stringify(state.itens))
    },
    ADD_ITEM (state, dados) {
        state.itens.unshift(dados)
        localStorage.setItem('carrinho', JSON.stringify(state.itens))
    },
    REMOVE_ITEM (state, dados) {
        state.itens = state.itens.filter(item => {
            if (item !== dados) {
                return item
            }
        })
        localStorage.setItem('carrinho', JSON.stringify(state.itens))
    },
    CLEAR_ITENS (state, dados) {
        state.itens = []
        localStorage.setItem('carrinho', JSON.stringify(state.itens))
    }
}
