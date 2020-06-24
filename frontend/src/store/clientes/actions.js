import { app as api } from '../../boot/App'

export const actions = {
    async autenticar ({ commit, getters }) {
        return new Promise((resolve, reject) => {
            if (!getters.cliente.token) {
                commit('REMOVE_CLIENTE')
                reject()
            }
            api.axios.defaults.headers.common.Authorization = getters.cliente.token
            resolve()
        })
    },
    async verificarFacebookSdk ({ commit }, payload) {
        return new Promise((resolve, reject) => {
            payload.FB.api('/me', 'GET', { fields: 'id,name,email' },
                userInformation => {
                    if (userInformation.error) {
                        reject('Não foi possível conectar sua conta com o facebook.')
                    }
                    commit('SET_DADOS_SDK', userInformation)
                    resolve(userInformation)
                }
            )
        })
    },
    async alterar ({ commit, dispatch }, dados) {
        const data = await api.service('clientes/api/alterar', dados, 'PUT')
        commit('SET_CLIENTE', data)
        commit('SET_CLIENTE_CONFIGURACOES', data)
        dispatch('autenticar')
        return data
    },
    async alterarConfiguracao ({ commit, dispatch, getters }, dados) {
        dispatch('autenticar')
        const configuracoes = Object.assign({}, getters.configuracoes, JSON.parse(dados))
        const data = await api.service('clientes/api/alterar', { configuracoes: configuracoes }, 'PUT')
        commit('SET_CLIENTE_CONFIGURACOES', data)
        return data
    },
    async sair ({ commit, getters }) {
        return new Promise((resolve, reject) => {
            if (getters.autenticado) {
                commit('REMOVE_CLIENTE')
                delete api.axios.defaults.headers.common.Authorization
                resolve()
            }
            reject('Você ainda não está autenticado.')
        })
    }
}
