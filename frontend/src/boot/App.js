import axios from 'axios'
import { Loading, Notify, Dialog, Dark } from 'quasar'
/**
 * App
 */
const app = {}
/**
 * Versionamento
 */
app.versao = "1.0.0"
/**
 * função vazia
 */
app.EmptyFn = () => { }
/**
 * Útil
 */
app.Util = {
    setLoading: ativar => {
        if (ativar !== false) {
            Loading.show({
                message: (ativar ? String(ativar) : null)
            })
            return
        }
        Loading.hide()
    },
    setMessage: (mensagem, tipo) => {
        if (!mensagem) {
            return
        }
        let cor, icone = false
        switch (tipo) {
            case 'success':
                cor = 'green'
                icone = 'done'
                break
            case 'fail':
                cor = 'red'
                icone = 'tv_off'
                break
            default:
                cor = 'blue'
                icone = 'touch_app'
                break
        }
        Notify.create({
            progress: true,
            multiLine: true,
            position: 'top',
            icon: icone,
            message: String(mensagem),
            color: cor
        })
    },
    setConfirm: (mensagem, success, fail) => {
        Dialog.create({
            title: 'Confirme',
            color: 'red',
            message: String(mensagem),
            cancel: true,
            persistent: true
        }).onOk(() => success())
            .onCancel(() => fail())
    }
}
/**
 * Aplicar configurações do cliente e padrões
 */
app.aplicarConfiguracoes = (cliente) => {
    if (cliente) {
        const configuracoes = JSON.parse(cliente.configuracoes)
        if (configuracoes) {
            if (Object.prototype.hasOwnProperty.call(configuracoes, 'escuro')) {
                Dark.set(configuracoes.escuro)
            }
        }
        return true
    }
    app.aplicarConfiguracoesPadroes()
}
app.aplicarConfiguracoesPadroes = () => {
    if (Dark.isActive) {
        Dark.set(false)
    }
}
/**
 * Service API
 */
app.axios = axios
app.service = (url, dados, metodo) => {
    let requisicao = app.EmptyFn
    axios.defaults.baseURL = 'http://localhost:8088/'
    axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded'

    switch (metodo.toUpperCase()) {
        case 'POST':
            requisicao = axios.post(url, dados)
            break
        case 'PUT':
            requisicao = axios.put(url, dados)
            break
        case 'DELETE':
            requisicao = axios.delete(url, dados)
            break
        default:
            requisicao = axios.get(url, { params: dados })
            break
    }

    return new Promise((resolve, reject) => {
        requisicao.then(response => {
            if (!response.data.success) {
                reject(response.data.message)
            }
            resolve(response.data)
        })
            .catch(error => reject(error))
    })
}

export default ({ Vue }) => {
    /**
     * exportando app global
     */
    Vue.prototype.$app = app
    /**
     * evento de on/offline
     */
    window.addEventListener('online', () => {
        app.Util.setLoading(false)
    })
    window.addEventListener('offline', () => {
        app.Util.setLoading('<b>Sua internet está fraca!</b><br />Verifique sua conexão com a internet.')
    })
    /**
     * filtro de moeda padrão
     */
    Vue.filter('moeda', function (valor) {
        return Number(valor).toLocaleString('pt-br', { style: 'currency', currency: 'BRL' })
    })
}

export { app }
