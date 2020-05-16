import { http } from './config'

export default {
  listaComCategorias: () => {
    return http.get('produtos/api/listaComCategorias')
  }
}
