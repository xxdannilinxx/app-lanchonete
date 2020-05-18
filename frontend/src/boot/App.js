import { baseURL } from '../api/loja'

export default ({ Vue }) => {
    Vue.prototype.$app = {
        baseURL: baseURL,
        version: "1.0.0"
    }
}
