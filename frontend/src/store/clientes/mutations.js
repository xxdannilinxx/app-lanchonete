export const mutations = {
    SET_CLIENTE (state, cliente) {
        state.cliente = cliente.data
        localStorage.setItem('cliente', JSON.stringify(cliente.data))
    },
    SET_DADOS_SDK (state, dadosSdk) {
        state.dadosSdk = {
            facebook: dadosSdk.id,
            nome: dadosSdk.name,
            email: dadosSdk.email
        }
    },
    SET_AUTENTICADO (state, status) {
        state.autenticado = status
    }
}
