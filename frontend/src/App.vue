<template>
  <div id="q-app">
    <div>
      <keep-alive>
        <router-view />
      </keep-alive>
    </div>
  </div>
</template>

<script>
import store from './store'
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'App',
  store,
  async created () {
    try {
      if (this.getAutenticado) {
        await this.actionAutenticarCliente()
      }
      await this.actionCarregarConfiguracoes()
      this.$app.aplicarConfiguracoesCliente(this.getClienteConfiguracoes)
    } catch (error) {
      this.$app.Util.setMessage(error, 'fail')
    }
  },
  computed: {
    ...mapGetters({
      getAutenticado: 'clientes/autenticado',
      getClienteConfiguracoes: 'clientes/configuracoes'
    })
  },
  methods: {
    ...mapActions({
      actionAutenticarCliente: 'clientes/autenticar',
      actionCarregarConfiguracoes: 'configuracoes/carregar'
    })
  }
}
</script>
