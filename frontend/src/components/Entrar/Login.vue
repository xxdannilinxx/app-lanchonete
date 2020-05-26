<template>
  <div class="q-pa-md">
    <q-list>

      <q-expansion-item
        v-if="facebookConectado === true"
        expand-separator
        class="q-mb-lg text-h6"
        icon="keyboard_arrow_left"
        label="Sair"
        header-class="text-red"
        expand-icon-class="hidden"
        router-link
        :to="{name: 'perfil'}"
      >
      </q-expansion-item>
    </q-list>

    <div class="absolute-center text-center">
      <img
        src="~assets/login.png"
        width="80%"
      />
      <h6 v-if="facebookConectado === true">Poxa! =(<br />fique mais um pouco conosco!</h6>
      <h6 v-if="facebookConectado === false">Oi! =)<br />é sempre bom tê-lo por aqui!</h6>

      <facebook-login
        v-if="configuracoes.facebookuid"
        class="q-pl-xs"
        :appId="configuracoes.facebookuid"
        @click="loading"
        @login="logar"
        @logout="deslogar"
        @sdk-loaded="sdkLoaded"
        loginLabel="Entrar com o facebook"
        logoutLabel="Encerrar minha sessão"
      >
      </facebook-login>
      <p
        v-if="facebookConectado === true"
        class="q-pt-xl text-primary"
      >Continue em nosso cardápio e faça seu pedido agora mesmo!</p>
      <p
        v-if="facebookConectado === false"
        class="q-pt-xl text-primary"
      >Pronto para visualizar nosso cardápio?</p>
    </div>

  </div>
</template>

<script>
import facebookLogin from 'facebook-login-vuejs'
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'Login',
  data () {
    return {
      facebookConectado: null
    }
  },
  components: {
    facebookLogin
  },
  computed: {
    ...mapGetters({
      cliente: 'clientes/cliente',
      dadosSdk: 'clientes/dadosSdk',
      configuracoes: 'configuracoes/configuracoes'
    })
  },
  methods: {
    async loading () {
      this.$app.Util.setLoading('Estamos conectando com o facebook')
    },
    async sdkLoaded (payload) {
      this.loading()
      this.facebookConectado = payload.isConnected
      this.$app.Util.setLoading(false)
    },
    async deslogar () {
      try {
        await this.sair()
          .then(() => {
            this.facebookConectado = false
            this.$app.aplicarConfiguracoesPadroes()
            this.$app.Util.setLoading(false)
          })
      } catch (error) {
        this.$app.Util.setLoading(false)
        this.$app.Util.setMessage(error, 'fail')
      }
    },
    async logar (payload) {
      try {
        if (payload && payload.isConnected === false) {
          throw new Error('Você precisa autenticar-se com o facebook!')
        }
        await this.verificarFacebookSdk(payload)
          .then(async response => {
            await this.alterar(this.dadosSdk)
              .then(response => {
                this.facebookConectado = true
                this.$app.aplicarConfiguracoes(this.cliente)
                this.$app.Util.setLoading(false)
                this.$router.push('/')
              })
          })
      } catch (error) {
        this.$app.Util.setLoading(false)
        this.$app.Util.setMessage(error, 'fail')
      }
    },
    ...mapActions({
      verificarFacebookSdk: 'clientes/verificarFacebookSdk',
      alterar: 'clientes/alterar',
      sair: 'clientes/sair',
      carregarConfiguracoes: 'configuracoes/carregar'
    })
  },
  async mounted () {
    try {
      await this.carregarConfiguracoes()
    } catch (error) {
      this.$app.Util.setMessage(error, 'fail')
    }
  }
}
</script>
