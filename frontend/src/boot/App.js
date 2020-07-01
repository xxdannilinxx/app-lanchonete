import axios from 'axios'
import moment from 'moment'
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
 * Região
 */
moment.locale('pt-br')
/**
 * Útil
 */
app.Util = {
    setLoading: ativar => {
        if (ativar !== false) {
            Loading.show({
                spinner: 'QSpinnerOval',
                spinnerColor: 'red',
                messageColor: 'red',
                backgroundColor: 'grey-3',
                message: (ativar ? String(ativar) : '')
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
                console.error(mensagem)
                break
            default:
                cor = 'blue'
                icone = 'touch_app'
                break
        }
        Notify.create({
            progress: true,
            multiLine: true,
            position: 'bottom',
            classes: 'q-mb-xl',
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
        }).onOk(success)
            .onCancel(fail)
    },
    setMoeda: (valor) => {
        return Number(valor).toLocaleString('pt-br', { style: 'currency', currency: 'BRL' })
    },
    setData: (data) => {
        return moment(String(data)).format('DD/MM/YYYY')
    },
    setHora: (hora) => {
        return moment(String(hora)).format('HH:mm')
    }
}
/**
 * Aplicar configurações do cliente e padrões
 */
app.aplicarConfiguracoesCliente = configuracoesCliente => {
    if (configuracoesCliente) {
        Dark.set(configuracoesCliente.escuro)
        return
    }
    app.aplicarConfiguracoesPadroesCliente()
}
app.aplicarConfiguracoesPadroesCliente = () => {
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
            requisicao = axios.delete(url, { data: dados })
            break
        case 'GET':
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
/**
 * Interceptar código 401
 */
app.axios.interceptors.response.use(function (response) {
    return response
}, function (error) {
    if (error.response.status === 401) {
        window.location = '/entrar'
        return false
    } else {
        return Promise.reject(error)
    }
})

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
     * filtros
     */
    Vue.filter('moeda', valor => {
        return app.Util.setMoeda(valor)
    })
    Vue.filter('data', data => {
        return app.Util.setData(data)
    })
    Vue.filter('hora', hora => {
        return app.Util.setHora(hora)
    })
}

export { app }
