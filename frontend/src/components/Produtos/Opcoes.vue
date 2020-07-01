<template>
  <q-page>
    <q-form
      v-if="carregado"
      @submit="enviarFormulario"
      class="q-gutter-md q-pa-sm"
    >
      <div
        v-for="(opcao, index) in getOpcoes"
        :key="index"
        class="bg-grey-2 q-pa-sm rounded-borders"
      >

        <div class="text-subtitle1">{{ opcao.opcao.nome }}</div>

        <div
          v-for="(opcional, index) in opcao.opcao.opcionais"
          :key="index"
        >
          <q-radio
            v-model="opcoes[opcao.id]"
            :val="opcional.id"
            :label="opcional.nome"
          />
          <span
            v-if="opcional.valor > 0"
            class="float-right text-caption text-weight-light bg-grey-4 q-pa-xs"
            rounded-borders
          >+{{ opcional.valor | moeda }}</span>
        </div>

        <q-radio
          v-if="opcao.obrigatorio"
          v-model="opcoes[opcao.id]"
          :val="undefined"
          label="Não"
          :checked="true"
        />
      </div>

      <div class="q-pa-sm text-center">
        <q-input
          v-model="observacao"
          filled
          type="textarea"
          label="Observação do produto, se necessário."
          hint="Exemplo: sem alface, com tomate, etc..."
        />
      </div>

      <div class="q-pa-md text-center">
        <q-btn
          label="-"
          round
          @click="quantidade > 1 ? quantidade-- : false"
        />
        <q-btn
          :label="quantidade"
          flat
        />
        <q-btn
          label="+"
          round
          @click="quantidade++"
        />
      </div>

      <div class="q-pa-xs">
        <q-btn
          color="primary"
          type="submit"
          class="full-width"
          @click="adicionar = true"
        >
          Adicionar ao carrinho {{ getValor() | moeda }}
        </q-btn>
        <q-btn
          flat
          color="primary"
          class="full-width q-ma-sm"
          label="Cancelar"
          router-link
          :to="{path: '/'}"
        >
        </q-btn>
      </div>

    </q-form>

    <q-dialog
      v-model="adicionar"
      persistent
    >
      <q-card>
        <q-card-section class="row items-center q-pb-none">
          <div class="text-h6">O que deseja?</div>
          <q-space />
        </q-card-section>

        <q-card-section>
          <q-btn
            flat
            label="Continuar"
            class="q-mr-sm"
            color="red"
            router-link
            :to="{path: '/'}"
            @click="adicionar = false"
          />
          <q-btn
            label="Finalizar compra"
            color="red"
            router-link
            :to="{name: 'carrinho'}"
            @click="adicionar = false"
          />
        </q-card-section>
      </q-card>
    </q-dialog>
  </q-page>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'Opcoes',
  data () {
    return {
      opcoes: [],
      opcoesSelecionadas: [],
      observacao: '',
      quantidade: 1,
      adicionar: false,
      carregado: false
    }
  },
  async mounted () {
    if (!this.getOpcoes.length) {
      this.$router.push({ name: 'inicio' })
    }
    this.carregado = true
  },
  computed: {
    ...mapGetters({
      getProduto: 'produtos/produto',
      getOpcoes: 'produtos/opcoes',
      getCarrinho: 'carrinho/itens'
    })
  },
  methods: {
    ...mapActions({
      actionCarrinhoAdicionar: 'carrinho/adicionar'
    }),
    getValor () {
      let total = 0
      this.opcoesSelecionadas.map(opcao => {
        total = (total + opcao.valor)
        return opcao.valor
      })
      return ((this.getProduto.valor * this.quantidade) + total)
    },
    async enviarFormulario () {
      this.actionCarrinhoAdicionar({
        produto: this.getProduto,
        quantidade: this.quantidade,
        observacao: this.observacao,
        valor: this.getValor(),
        opcoes: this.opcoesSelecionadas
      })
      this.opcoes = []
      this.opcoesSelecionadas = []
      this.observacao = ''
      this.quantidade = 1
    }
  },
  watch: {
    opcoes () {
      this.opcoesSelecionadas = []
      this.getOpcoes.map(opcao => {
        if (this.opcoes[opcao.id]) {
          opcao.opcao.opcionais.map(opcional => {
            if (this.opcoes[opcao.id] === opcional.id) {
              opcional.opcao = opcao.opcao.nome
              this.opcoesSelecionadas.unshift(opcional)
              return opcional
            }
          })
        }
      })
    }
  }
}
</script>
