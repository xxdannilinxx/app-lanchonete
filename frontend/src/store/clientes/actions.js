import { app as api } from '../../boot/App'

export const actions = {
    async verificarFacebookSdk ({ commit }, payload) {
        return new Promise((resolve, reject) => {
            payload.FB.api('/me', 'GET', { fields: 'id,name,email' },
                userInformation => {
                    if (userInformation.error) {
                        reject('Não foi possível integrar sua conta com o facebook')
                    }
                    commit('SET_DADOS_SDK', userInformation)
                    resolve(userInformation)
                }
            )
        })
    },
    async alterar ({ commit, dispatch, getters }, dados) {
        const data = await api.service('clientes/api/alterar', dados, 'PUT')
        commit('SET_CLIENTE', data)
        if (!getters.autenticado) {
            dispatch('autenticar')
        }
        return data
    },
    async autenticar ({ commit, getters }) {
        return new Promise((resolve, reject) => {
            if (getters.conectado) {
                reject('Você já está autenticado.')
            }
            if (!getters.cliente || !Object.prototype.hasOwnProperty.call(getters.cliente, 'token')) {
                reject('O seu token não foi encontrado.')
            }
            api.axios.defaults.headers.common.Authorization = getters.cliente.token
            commit('SET_AUTENTICADO', true)
            resolve()
        })
    },
    async sair ({ commit, getters }) {
        return new Promise((resolve, reject) => {
            if (getters.autenticado) {
                commit('SET_AUTENTICADO', false)
                localStorage.removeItem('cliente')
                delete api.axios.defaults.headers.common.Authorization
                resolve()
            }
            reject('Você ainda não está autenticado.')
        })
    }
}
