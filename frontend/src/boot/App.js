import { baseURL, token } from '../services/config'

export default ({ Vue }) => {
    Vue.prototype.$app = {
        baseURL: baseURL,
        token: token
    }
}
