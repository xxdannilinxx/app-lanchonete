<template>
  <div class="q-pa-md">

    <q-input
      :loading="carregando"
      v-model="cupom"
      debounce="1000"
      filled
      placeholder="Cupom"
      hint="Insira seu cupom de desconto"
    >
      <template v-slot:append>
        <q-icon name="local_offer" />
      </template>
    </q-input>

    <q-btn
      v-if="getCupom.nome && !carregando"
      color="primary"
      icon="delete"
      size="xs"
      class="q-ma-sm"
      :label="'Remover cupom aplicado ' + getCupom.porcentagem + '%'"
      @click="cupom = ''"
    />

  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'

export default {
  name: 'Lista',
  data () {
    return {
      cupom: '',
      carregando: false
    }
  },
  async mounted () {
    if (this.getCupom) {
      this.cupom = this.getCupom.nome
    }
  },
  computed: {
    ...mapGetters({
      getCupons: 'cuponsDeDesconto/cupons',
      getCupom: 'cuponsDeDesconto/cupom'
    })
  },
  methods: {
    ...mapActions({
      actionCuponsDeDescontoBuscar: 'cuponsDeDesconto/buscar',
      actionCuponsDeDescontoSelecionar: 'cuponsDeDesconto/selecionar',
      actionCuponsDeDescontoRemover: 'cuponsDeDesconto/remover'
    })
  },
  watch: {
    async cupom (newVal) {
      if (!newVal) {
        await this.actionCuponsDeDescontoRemover()
        return
      }
      try {
        this.carregando = true
        await this.actionCuponsDeDescontoBuscar({
          nome: newVal,
          max: 1
        })
          .then(async () => {
            if (this.getCupons.length === 0) {
              this.carregando = false
              await this.actionCuponsDeDescontoRemover()
              this.$app.Util.setMessage('Cupom não encontrado.', 'fail')
              return
            }
            await this.actionCuponsDeDescontoSelecionar(this.getCupons[0])
            this.carregando = false
          })
      } catch (error) {
        this.carregando = false
        this.$app.Util.setMessage(error, 'fail')
      }
    }
  }
}
</script>
