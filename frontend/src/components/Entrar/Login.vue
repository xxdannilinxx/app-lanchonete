<template>
  <div>
    <BarraTop v-if="facebookConectado === true" />
    <div class="
      absolute-center
      text-center">
      <img
        src="~assets/login.png"
        width="80%"
      />
      <h6>{{ facebookConectado === true ? 'Poxa! =( fique mais um pouco conosco!' : 'Oi! =) é sempre bom tê-lo por aqui!'}}</h6>
      <facebook-login
        v-if="getConfiguracoes.facebookuid"
        class="q-pl-xs"
        :appId="getConfiguracoes.facebookuid"
        @click="loading"
        @login="entrar"
        @logout="sair"
        @sdk-loaded="sdkLoaded"
        loginLabel="Entrar com o facebook"
        logoutLabel="Encerrar minha sessão"
      >
      </facebook-login>
      <p class="q-pt-xl text-primary">{{ facebookConectado === true ? 'Continue em nosso cardápio e faça seu pedido agora mesmo!' : 'Pronto para visualizar nosso cardápio?'}}</p>
    </div>
  </div>
</template>

<script>
import BarraTop from '../abstratos/barratop'
import { mapGetters, mapActions } from 'vuex'
import facebookLogin from 'facebook-login-vuejs'

export default {
  name: 'Login',
  components: {
    BarraTop,
    facebookLogin
  },
  data () {
    return {
      facebookConectado: ''
    }
  },
  computed: {
    ...mapGetters({
      getConfiguracoesCliente: 'clientes/configuracoes',
      getDadosSdk: 'clientes/dadosSdk',
      getConfiguracoes: 'configuracoes/configuracoes'
    })
  },
  methods: {
    ...mapActions({
      actionVerificarFacebookSdk: 'clientes/verificarFacebookSdk',
      actionClienteAlterar: 'clientes/alterar',
      actionClienteSair: 'clientes/sair'
    }),
    async loading () {
      this.$app.Util.setLoading('Conectando com o facebook...')
    },
    async sdkLoaded (payload) {
      this.loading()
      this.facebookConectado = payload.isConnected
      this.$app.Util.setLoading(false)
    },
    async sair () {
      try {
        await this.actionClienteSair()
          .then(() => {
            this.facebookConectado = false
            this.$app.aplicarConfiguracoesPadroesCliente()
            this.$app.Util.setLoading(false)
          })
      } catch (error) {
        this.$app.Util.setLoading(false)
        this.$app.Util.setMessage(error, 'fail')
      }
    },
    async entrar (payload) {
      try {
        if (payload && payload.isConnected === false) {
          throw new Error('Você precisa autenticar-se com o facebook!')
        }
        await this.actionVerificarFacebookSdk(payload)
          .then(async response => {
            await this.actionClienteAlterar(this.getDadosSdk)
              .then(response => {
                this.facebookConectado = true
                this.$app.aplicarConfiguracoesCliente(this.getConfiguracoesCliente)
                this.$router.push('/')
                this.$app.Util.setLoading(false)
              })
          })
      } catch (error) {
        this.$app.Util.setLoading(false)
        this.$app.Util.setMessage(error, 'fail')
      }
    }
  }
}
</script>
