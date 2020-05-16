<template>
  <q-page class="flex bg-grey-3 column">
  <div v-if="!produtos.length && carregado" class="nenhum-resultado fixed-center text-center">
    <p>
      <img
        src="~assets/sad.svg"
        style="width:30vw;max-width:150px;"
      >
    </p>
    <p class="text-faded">
      Desculpe, não encontramos nada por aqui.
    </p>
  </div>

  <div v-if="produtos.length" class="q-pa-md q-gutter-md bg-white">

    <div v-for="categoria in produtos" :key="categoria.nome">
    {{ categoria.nome }}

    <p v-if="!categoria.produtos.length" class="text-faded">
      Desculpe, não encontramos nada por aqui.
    </p>

    <q-list v-for="produto in categoria.produtos" :key="produto.id">

   <q-item clickable :to="'/produto/' + produto.id" v-ripple>
        <q-item-section avatar>
          <q-avatar>
            <img src="https://cdn.quasar.dev/img/avatar2.jpg">
          </q-avatar>
        </q-item-section>

        <q-item-section>
          <q-item-label lines="1">{{ produto.nome }}</q-item-label>
          <q-item-label caption lines="2">
            {{ produto.descricao }}
          </q-item-label>
        </q-item-section>

        <q-item-section side top>
          {{ Util.getMoeda(produto.valor) }}
        </q-item-section>
      </q-item>

      <q-separator inset="item" />

    </q-list>

    </div>

  </div>
  </q-page>
</template>

<script>
import Util from '../services/util'
import ProdutoService from '../services/produto'

export default {
  data () {
    return {
      Util: Util,
      produtos: [],
      carregado: false
    }
  },
  methods: {
    listaComCategorias () {
      const me = this
      Util.setLoading()
      ProdutoService.listaComCategorias()
        .then((response) => {
          if (response.data.success) {
            me.produtos = response.data.data
            console.log(response.data)
            return
          }
          throw response.data.message
        })
        .catch((response) => {
          Util.setMensagem(response, 'red')
        })
        .then(() => {
          me.carregado = true
          Util.setLoading(false)
        })
    }
  },
  mounted () {
    this.listaComCategorias()
  }
}
</script>
