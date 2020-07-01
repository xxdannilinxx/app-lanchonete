<template>
  <div class="q-pa-md">
    <div
      v-if="!getPedidos.length && carregado"
      class="text-center"
    >
      <p>
        <img
          src="~assets/sad.svg"
          style="width:30vw;max-width:150px;"
        />
      </p>
      <p class="text-faded">Você não tem nenhum pedido até o momento.</p>
    </div>

    <div v-if="carregado">
      <q-list
        v-for="(pedido, index) in getPedidos"
        :key="index"
      >
        <q-card
          class="q-mb-md"
          flat
          bordered
        >
          <q-card-section horizontal>
            <q-card-section class="q-pt-xs col-8">
              <div class="text-overline">Pedido #{{ pedido.id }}</div>
              <div class="text-h5 q-mt-sm q-mb-xs">de {{ pedido.valor | moeda }}</div>
              <div class="text-caption text-grey">
                {{ `${pedido.endereco.endereco}, ${pedido.endereco.complemento}` }}
              </div>
            </q-card-section>

            <q-card-section class="col-2">
              <q-circular-progress
                :value="situacao(pedido.situacao)"
                size="30px"
                :thickness="0.22"
                color="primary"
                track-color="grey-3"
                class="q-ma-md"
              />
            </q-card-section>
          </q-card-section>

          <q-separator />

          <q-card-actions>
            <q-btn
              flat
              round
              icon="event"
            />
            <q-btn flat>
              {{ pedido.data.date | data }}
            </q-btn>
            <q-btn flat>
              {{ pedido.data.date | hora }}
            </q-btn>
            <q-btn
              flat
              class="text-primary"
            >
              {{ pedido.formadepagamento.nome }}
            </q-btn>
            <q-space />

            <q-btn
              color="grey"
              round
              flat
              dense
              icon="keyboard_arrow_down"
              @click="expandir(pedido.id)"
            />
          </q-card-actions>

          <div
            :ref="'pedido' + pedido.id"
            hidden
          >
            <q-separator />
            <q-card-section class="text-subitle2">

              <q-list
                v-for="(item, index) in pedido.itens"
                :key="index"
                separator
              >
                <q-item
                  clickable
                  v-ripple
                >
                  <q-item-section>{{ item.quantidade }}x - {{ item.produto.nome }} {{ item.valor | moeda }}</q-item-section>
                </q-item>
              </q-list>

            </q-card-section>
          </div>
        </q-card>
      </q-list>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'

export default {
  name: 'Lista',
  data () {
    return {
      carregado: false
    }
  },
  async mounted () {
    try {
      this.$app.Util.setLoading('Buscando pedidos...')
      await this.actionPedidosListar()
        .then(() => {
          this.carregado = true
          this.$app.Util.setLoading(false)
          setInterval(() => {
            this.atualizarPedidos()
          }, 30000)
        })
    } catch (error) {
      this.carregado = true
      this.$app.Util.setLoading(false)
      this.$app.Util.setMessage(error, 'fail')
    }
  },
  computed: {
    ...mapGetters({
      getPedidos: 'pedidos/pedidos',
      getItens: 'pedidos/itens'
    })
  },
  methods: {
    ...mapActions({
      actionPedidosListar: 'pedidos/lista',
      actionPedidosItensListar: 'pedidos/listaItens'
    }),
    async atualizarPedidos () {
      try {
        await this.actionPedidosListar()
      } catch (error) {
        this.$app.Util.setMessage(error, 'fail')
      }
    },
    situacao (situacao) {
      switch (situacao) {
        case 'ativo':
          return 30
        case 'preparando':
          return 60
        case 'entrega':
          return 90
        default:
          return 100
      }
    },
    expandir (id) {
      this.$refs['pedido' + id][0].hidden = !this.$refs['pedido' + id][0].hidden
    }
  }
}
</script>
