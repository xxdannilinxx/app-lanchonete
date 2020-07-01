export const mutations = {
    SET_ENDERECOS (state, enderecos) {
        state.enderecos = enderecos.data
    },
    SET_ENDERECO (state, endereco) {
        state.endereco = endereco.data
    },
    ADD_ENDERECO (state, dados) {
        state.enderecos.unshift(dados.data)
    },
    UPDATE_ENDERECO (state, dados) {
        state.enderecos = state.enderecos.map(endereco => {
            if (endereco.id === dados.id) {
                return Object.assign({}, endereco, dados)
            }
            return endereco
        })
    },
    REMOVE_ENDERECO (state, dados) {
        state.enderecos = state.enderecos.filter(endereco => {
            if (endereco.id !== dados.id) {
                return endereco
            }
        })
    },
    UPDATE_ENDERECO_PADRAO (state, dados) {
        state.enderecoPadrao = dados
    }
}
