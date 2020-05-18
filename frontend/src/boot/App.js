import { baseURL } from '../services/config'

export default ({ Vue }) => {
    Vue.prototype.$app = {
        baseURL: baseURL
    }
}
