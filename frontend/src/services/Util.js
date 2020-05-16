import { Loading, Notify } from 'quasar'

export default {
    /**
     * mostrar loading
     */
    setLoading: (ativar) => {
        if (ativar !== false) {
            Loading.show()
            return
        }
        Loading.hide()
    },
    /**
     * mostrar notificação
     */
    setMensagem: (mensagem, cor) => {
        Notify.create({
            message: String(mensagem),
            color: String(cor)
        })
    },
    /**
     * retorna em real brasileiro com R$
     */
    getMoeda: (valor) => {
        return Number(valor).toLocaleString('pt-br', { style: 'currency', currency: 'BRL' })
    }
}
