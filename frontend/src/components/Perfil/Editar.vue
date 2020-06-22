<template>
  <div class="q-pa-md">
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
        :rules="[ val => val && val.length > 0 || 'Por favor, digite o seu cpf']"
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
        :rules="[ val => val && val.length > 0 || 'Por favor, digite o número do seu telefone']"
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
  </div>
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
      nome: this.cliente.nome,
      email: this.cliente.email,
      cpf: this.cliente.cpf,
      telefone: this.cliente.telefone
    }
  },
  computed: {
    ...mapGetters('clientes', [
      'cliente'
    ])
  },
  methods: {
    ...mapActions('clientes', [
      'alterar'
    ]),
    async enviarFormulario () {
      try {
        this.progresso = true
        await this.alterar({
          cpf: this.dados.cpf,
          telefone: this.dados.telefone
        })
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
