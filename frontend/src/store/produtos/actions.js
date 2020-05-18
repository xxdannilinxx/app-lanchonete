import { http } from '../../api/loja'

export const actions = {
    lista ({ commit }) {
        return http.get('produtos/api/lista')
            .then(response => {
                if (response.data.success) {
                    commit('SET_ITEMS', response.data.data)
                }
                return response.data
            })
            .catch(response => {
                commit('SET_ITEMS', [])
                return {
                    success: false,
                    message: String(response),
                    data: []
                }
            })
            .then(response => {
                commit('SET_LOADED', true)
                return response
            })
    }
}
