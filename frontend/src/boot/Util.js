import { Loading, Notify } from 'quasar'

export default ({ Vue }) => {
    Vue.prototype.$app.Util = {
        setLoading: ativar => {
            if (ativar !== false) {
                Loading.show({
                    message: '<b>Só mais um momento!</b><br />' + (ativar ? String(ativar) : '')
                })
                return
            }
            Loading.hide()
        },
        setMessage: (mensagem, tipo) => {
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
                position: 'top',
                progress: true,
                multiLine: true,
                icon: icone,
                message: String(mensagem),
                color: cor
            })
        }
    }
}
