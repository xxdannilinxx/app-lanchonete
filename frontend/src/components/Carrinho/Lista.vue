<template>
  <q-form
    v-if="carregado"
    @submit="enviarFormulario"
    class="q-ma-md"
  >
    <div class="text-h5">Carrinho</div>
    <div
      v-if="!getItens.length"
      class="text-center"
    >
      <p>
        <img
          src="~assets/sad.svg"
          style="width:30vw;max-width:150px;"
        />
      </p>
      <p class="text-faded">Ops! seu carrinho ainda está vazio.</p>
    </div>

    <div
      v-for="(item, index) in getItens"
      :key="index"
      class="bg-grey-2 q-pa-md rounded-borders"
    >

      <div class="text-subtitle1">
        <q-btn
          round
          color="primary"
          icon="delete"
          size="xs"
          @click="actionCarrinhoRemover(item)"
        /> {{ item.quantidade }}x - {{ item.produto.nome }} {{ item.valor | moeda }}</div>
      <div
        class="text-subtitle2"
        v-for="(opcao, index) in item.opcoes"
        :key="index"
      >
        {{ opcao.opcao }} - {{ opcao.nome }} {{ opcao.valor | moeda }}</div>
      <div class="text-caption"> {{ item.observacao }}</div>
      <q-separator />

    </div>

    <div class="text-h6 q-ma-sm">Endereço</div>
    <EnderecosLista />

    <div class="text-h6 q-ma-sm">Cupom</div>
    <CuponsDeDesconto />

    <div class="text-h6 q-ma-sm">Forma de Pagamento</div>
    <FormasDePagamentoLista />

    <div class="text-h6 q-ma-sm">Valores</div>
    <div class="text-caption">Produtos: <div class="float-right">{{ getProdutosValores() | moeda }}</div>
    </div>
    <div class="text-caption">Taxa de entrega: <div class="float-right">{{ getTaxaEntrega() | moeda }}</div>
    </div>
    <div class="text-caption">Sub-Total: <div class="float-right">{{ getSubTotal() | moeda }}</div>
    </div>
    <q-separator />
    <div v-if="getCupomDesconto() > 0">
      <div class="text-caption">Desconto do cupom: <div class="text-red float-right">({{ getCupomDesconto() }}%) {{ getCupomDescontoValor() | moeda }}</div>
        <q-separator />
      </div>
    </div>
    <div class="text-caption">Total: <div class="float-right">{{ getTotal() | moeda }}</div>
    </div>

    <div class="text-h6 q-ma-sm">Informações <router-link
        to="perfil/editar"
        class="float-right text-caption text-red"
      >
        Alterar
      </router-link>
    </div>
    <div class="text-caption">{{ getCliente.nome }}</div>
    <div class="text-caption">{{ getCliente.email }}</div>

    <div class="text-h6 q-ma-sm">Observação</div>
    <q-input
      v-model="observacao"
      filled
      type="textarea"
      label="Observação do pedido, se necessário."
      hint="Exemplo: rua sem saída, etc..."
    />

    <div class="q-pa-xs q-pt-md">
      <q-btn
        :loading="progresso"
        color="primary"
        type="submit"
        class="full-width"
      >
        Confirmar Pedido
        <template v-slot:loading>
          <q-spinner-oval />
        </template>
      </q-btn>
    </div>
  </q-form>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import EnderecosLista from '../../components/perfil/enderecos/lista'
import FormasDePagamentoLista from '../../components/formasdepagamento/lista'
import CuponsDeDesconto from '../../components/cuponsdedesconto/adicionar'

export default {
  name: 'Lista',
  components: {
    EnderecosLista,
    FormasDePagamentoLista,
    CuponsDeDesconto
  },
  data () {
    return {
      observacao: '',
      carregado: false,
      progresso: false
    }
  },
  async mounted () {
    this.carregado = true
  },
  computed: {
    ...mapGetters({
      getCliente: 'clientes/cliente',
      getItens: 'carrinho/itens',
      getConfiguracoes: 'configuracoes/configuracoes',
      getCupom: 'cuponsDeDesconto/cupom',
      getFormaDePagamento: 'formasDePagamento/formaDePagamento',
      getFormaDePagamentoTroco: 'formasDePagamento/troco',
      getEnderecos: 'enderecos/enderecos',
      getEnderecoPadrao: 'enderecos/enderecoPadrao',
      getPedidos: 'pedidos/pedidos'
    })
  },
  methods: {
    ...mapActions({
      actionPedidosAdicionar: 'pedidos/adicionar',
      actionCarrinhoRemover: 'carrinho/remover',
      actionCarrinhoLimpar: 'carrinho/limpar',
      actionFormaDePagamentoLimpar: 'formasDePagamento/limpar',
      actionCuponsDeDescontoRemover: 'cuponsDeDesconto/remover'
    }),
    getProdutosValores () {
      let subtotal = 0
      this.getItens.map(item => {
        subtotal = (subtotal + item.valor)
      })
      return subtotal
    },
    getTaxaEntrega () {
      let taxaEntrega = 0
      this.getEnderecos.map(endereco => {
        if (endereco.id === this.getEnderecoPadrao) {
          taxaEntrega = endereco.bairro.valor
          return endereco.bairro.valor
        }
      })
      return taxaEntrega
    },
    getSubTotal () {
      return (this.getProdutosValores() + this.getTaxaEntrega())
    },
    getCupomDesconto () {
      let desconto = 0
      if (this.getCupom) {
        desconto = this.getCupom.porcentagem
      }
      return desconto
    },
    getCupomDescontoValor () {
      return (this.getSubTotal() - this.getTotal())
    },
    getTotal () {
      let total = this.getSubTotal()
      if (this.getCupomDesconto() > 0) {
        total = total - ((total * this.getCupomDesconto()) / 100)
      }
      return total
    },
    async enviarFormulario () {
      if (!this.getCliente) {
        this.$app.Util.setMessage('Nenhum cliente selecionado.')
        return
      }
      if (!this.getItens.length) {
        this.$app.Util.setMessage('Nenhum produto adicionado ao carrinho.')
        return
      }
      if (!this.getConfiguracoes.aberto) {
        this.$app.Util.setMessage('Desculpe, nós não estamos mais abertos.')
        return
      }
      if (!this.getEnderecoPadrao) {
        this.$app.Util.setMessage('Nenhum endereço selecionado.')
        return
      }
      if (!this.getFormaDePagamento.id) {
        this.$app.Util.setMessage('Nenhuma forma de pagamento selecionada.')
        return
      }
      if (this.getFormaDePagamento.troco === 1) {
        if (!this.getFormaDePagamentoTroco) {
          this.$app.Util.setMessage('O valor do troco precisa ser específicado.')
          return
        }
        if (this.getFormaDePagamentoTroco < this.getTotal()) {
          this.$app.Util.setMessage('O valor específicado no troco precisa ser maior ou igual que o total do pedido.')
          return
        }
      }
      if (this.getTotal() <= 0) {
        this.$app.Util.setMessage('Valor total do pedido não encontrado.')
        return
      }
      try {
        this.$app.Util.setLoading('Realizando pedido...')
        const itens = []
        this.getItens.map(item => {
          let descricao = ''
          item.opcoes.map(opcoes => {
            descricao = opcoes.opcao + ' - ' + opcoes.nome + ' (' + this.$app.Util.setMoeda(opcoes.valor) + ')\n'
            return opcoes
          })
          itens.unshift({
            valor: item.valor,
            produto: item.produto.id,
            descricao: descricao,
            quantidade: item.quantidade,
            observacao: item.observacao
          })
        })
        await this.actionPedidosAdicionar({
          cliente: this.getCliente.id,
          valor: this.getTotal(),
          valorEntrega: this.getTaxaEntrega(),
          troco: this.getFormaDePagamentoTroco,
          cupom: this.getCupom.id,
          endereco: this.getEnderecoPadrao,
          formaDePagamento: this.getFormaDePagamento.id,
          observacao: this.observacao,
          itens: itens

        })
          .then(async () => {
            await this.actionCarrinhoLimpar()
            await this.actionCuponsDeDescontoRemover()
            await this.actionFormaDePagamentoLimpar()
            this.$router.push({ name: 'pedidos' })
            this.$app.Util.setLoading(false)
          })
      } catch (error) {
        this.$app.Util.setLoading(false)
        this.$app.Util.setMessage(error, 'fail')
      }
    }
  }
}
</script>
