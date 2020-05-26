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
  store,
  name: 'Main',
  computed: {
    ...mapGetters({
      cliente: 'clientes/cliente',
      autenticado: 'clientes/autenticado'
    })
  },
  methods: {
    ...mapActions({
      autenticar: 'clientes/autenticar',
      carregar: 'configuracoes/carregar'
    })
  },
  async mounted () {
    try {
      /**
       * Carrega configurações da loja
       */
      await this.carregar()
      /**
       * Verifica autenticação
       */
      if (!this.cliente) {
        this.$router.push('/entrar')
        return false
      }
      if (!this.autenticado) {
        await this.autenticar()
      }
      /**
       * Verifica configurações impostas pelo cliente
       */
      this.$app.aplicarConfiguracoes(this.cliente)
    } catch (error) {
      this.$app.Util.setMessage(error, 'fail')
    }
  }
}
</script>
