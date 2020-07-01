export const mutations = {
    SET_FORMAS (state, dados) {
        state.formas = dados.data
    },
    SET_FORMA_DE_PAGAMENTO (state, formaSelecionada) {
        state.formas.map(formaDePagamento => {
            if (formaDePagamento.id === formaSelecionada) {
                state.formaDePagamento = formaDePagamento
                return formaDePagamento
            }
            return formaDePagamento
        })
    },
    SET_TROCO (state, dados) {
        state.troco = dados
    },
    LIMPAR_FORMA_DE_PAGAMENTO (state) {
        state.formaDePagamento = {}
    }
}
