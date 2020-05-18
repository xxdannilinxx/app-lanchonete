import { http } from './config'

export default {
  listaComCategorias: () => {
    return await http.get('produtos/api/listaComCategorias')
  }
}
