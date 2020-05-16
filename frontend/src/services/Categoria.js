import { http } from './config'

export default {
  lista: () => {
    return http.get('categorias/api/lista')
  }
}
