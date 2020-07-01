export const mutations = {
    SET_CUPONS (state, dados) {
        state.cupons = dados.data
    },
    SET_CUPOM (state, dados) {
        state.cupom = dados
    },
    REMOVE_CUPOM (state) {
        state.cupom = {}
    }
}
