export const mutations = {
    SET_CLIENTE (state, cliente) {
        state.cliente = cliente.data
        localStorage.setItem('cliente', JSON.stringify(state.cliente))
    },
    SET_CLIENTE_CONFIGURACOES (state, dados) {
        state.configuracoes = dados.data.configuracoes
        localStorage.setItem('configuracoes', JSON.stringify(state.configuracoes))
    },
    SET_DADOS_SDK (state, dadosSdk) {
        state.dadosSdk = {
            facebook: dadosSdk.id,
            nome: dadosSdk.name,
            email: dadosSdk.email
        }
    },
    REMOVE_CLIENTE (state) {
        state.cliente = ''
        state.configuracoes = ''
        localStorage.removeItem('cliente')
        localStorage.removeItem('configuracoes')
    }
}
