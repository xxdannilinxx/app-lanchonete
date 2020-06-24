export const getters = {
    cliente: state => state.cliente,
    configuracoes: state => state.configuracoes,
    dadosSdk: state => state.dadosSdk,
    autenticado: state => !!state.cliente
}
