<template>
  <div class="q-pa-md">
    <div
      v-for="(forma, index) in getFormas"
      :key="index"
    >
      <q-radio
        v-model="formaSelecionada"
        :val="forma.id"
        :label="forma.nome"
      />
      <q-input
        v-if="forma.troco && formaSelecionada === forma.id"
        filled
        type="number"
        step="0.01"
        v-model="troco"
        label="Troco para"
        prefix="R$"
        hint="Digite o valor"
        value="0"
        lazy-rules
        :rules="[ val => val && val !== 0 || 'Por favor, digite um valor']"
      />
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'

export default {
  name: 'Lista',
  data () {
    return {
      formaSelecionada: '',
      troco: 0
    }
  },
  async mounted () {
    try {
      await this.actionFormasDePagamentoListar()
    } catch (error) {
      this.$app.Util.setMessage(error, 'fail')
    }
  },
  computed: {
    ...mapGetters({
      getTroco: 'formasDePagamento/troco',
      getFormas: 'formasDePagamento/formas',
      getFormaDePagamento: 'formasDePagamento/formaDePagamento'
    })
  },
  methods: {
    ...mapActions({
      actionFormasDePagamentoListar: 'formasDePagamento/lista',
      actionFormasDePagamentoTrocoAlterar: 'formasDePagamento/alterarTroco',
      actionFormasDePagamentoSelecionar: 'formasDePagamento/selecionar'
    })
  },
  watch: {
    async formaSelecionada (newVal) {
      try {
        await this.actionFormasDePagamentoSelecionar(newVal)
          .then(() => {
            if (!this.getFormaDePagamento.troco) {
              this.troco = 0
            }
          })
      } catch (error) {
        this.$app.Util.setMessage(error, 'fail')
      }
    },
    async troco (newVal) {
      try {
        await this.actionFormasDePagamentoTrocoAlterar(newVal)
      } catch (error) {
        this.$app.Util.setMessage(error, 'fail')
      }
    }
  }
}
</script>
