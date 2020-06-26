<template>
  <q-page class="q-pa-md">
    <q-form
      @submit="enviarFormulario"
      class="q-gutter-md"
    >
      <q-input
        filled
        v-model="dados.nome"
        label="Seu nome *"
        hint="Nome e sobrenome"
        maxlength="255"
        readonly
      />
      <q-input
        filled
        v-model="dados.email"
        label="Seu e-mail *"
        hint="Endereço de e-mail"
        maxlength="255"
        readonly
      />
      <q-input
        filled
        v-model="dados.cpf"
        label="Seu cpf *"
        hint="000.000.000-00"
        mask="###.###.###-##"
        maxlength="45"
        clearable
        autofocus
        lazy-rules
        :rules="[ val => val && val.length === 14 || 'Por favor, digite o seu cpf']"
      />
      <q-input
        filled
        v-model="dados.telefone"
        label="Seu telefone *"
        hint="(00) 00000-0000"
        mask="(##) #####-####"
        maxlength="45"
        clearable
        lazy-rules
        :rules="[ val => val && val.length === 15 || val.length + 'Por favor, digite o número do seu telefone']"
      />

      <div class="q-pa-xs q-pt-md">
        <q-btn
          :loading="progresso"
          color="primary"
          type="submit"
          class="full-width"
        >
          Salvar
          <template v-slot:loading>
            <q-spinner-oval />
          </template>
        </q-btn>
      </div>
    </q-form>
  </q-page>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'

export default {
  name: 'EditarPerfil',
  data () {
    return {
      dados: {},
      progresso: false
    }
  },
  async mounted () {
    this.dados = {
      nome: this.getCliente.nome,
      email: this.getCliente.email,
      cpf: this.getCliente.cpf,
      telefone: this.getCliente.telefone
    }
  },
  computed: {
    ...mapGetters({
      getCliente: 'clientes/cliente'
    })
  },
  methods: {
    ...mapActions({
      actionClienteAlterar: 'clientes/alterar'
    }),
    async enviarFormulario () {
      try {
        this.progresso = true
        await this.actionClienteAlterar(this.dados)
          .then(response => {
            this.progresso = false
            this.$router.go(-1)
          })
      } catch (error) {
        this.progresso = false
        this.$app.Util.setMessage(error, 'fail')
      }
    }
  }
}
</script>
