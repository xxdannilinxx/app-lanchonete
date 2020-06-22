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
  name: 'Main',
  store,
  created () {
    try {
      this.carregar()
      if (!this.cliente) {
        if (this.$route.name !== 'entrar') {
          this.$router.push('/entrar')
        }
        return false
      }
      if (!this.autenticado) {
        this.autenticar()
      }
      this.$app.aplicarConfiguracoes(this.cliente)
    } catch (error) {
      this.$app.Util.setMessage(error, 'fail')
    }
  },
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
  }
}
</script>
