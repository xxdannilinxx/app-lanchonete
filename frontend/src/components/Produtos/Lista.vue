<template>
  <q-pull-to-refresh
    @refresh="atualizar"
    color="red"
    icon="lightbulb"
  >
    <q-banner
      v-if="configuracoes.aberto === 0"
      class="bg-grey-3"
    >
      <template v-slot:avatar>
        <q-icon
          name="signal_wifi_off"
          color="primary"
        />
      </template>
      No momento estamos fechados.
      <template v-slot:action>
        <q-btn
          flat
          color="primary"
          label="ver horários"
          router-link
          :to="{name: 'informacoes'}"
        />
      </template>
    </q-banner>

    <q-page>
      <div
        v-if="!categorias.length && final"
        class="fixed-center text-center"
      >
        <p>
          <img
            src="~assets/sad.svg"
            style="width:30vw;max-width:150px;"
          />
        </p>
        <p class="text-faded">Ops! nosso cardápio ainda está vazio.</p>
      </div>

      <div class="q-pa-md q-gutter-md">
        <q-infinite-scroll
          @load="carregar"
          :offset="250"
          ref="infiniteScroll"
        >

          <div
            v-for="(categoria, index) in categorias"
            :key="index"
          >
            <p class="text-subtitle1 text-primary q-pt-md">{{ categoria.nome }}</p>
            <p
              v-if="!categoria.produtos.length"
              class="text-faded"
            >Desculpe, não encontramos nada por aqui.</p>

            <q-list
              v-for="(produto, index) in categoria.produtos"
              :key="index"
            >
              <q-item
                clickable
                :to="'/produto/' + produto.id"
                v-ripple
              >
                <q-item-section avatar>
                  <q-avatar>
                    <img :src="produto.imagem" />
                  </q-avatar>
                </q-item-section>

                <q-item-section>
                  <q-item-label lines="1">{{ produto.nome }}</q-item-label>
                  <q-item-label
                    caption
                    lines="2"
                  >{{ produto.descricao }}</q-item-label>
                </q-item-section>

                <q-item-section
                  side
                  top
                >{{ produto.valor | moeda }}</q-item-section>
              </q-item>

              <q-separator inset="item" />
            </q-list>
          </div>

          <template
            v-if="!final"
            slot="loading"
          >
            <q-item style="max-width: 300px">
              <q-item-section>
                <q-item-label caption>
                  <q-skeleton
                    type="text"
                    width="30%"
                  />
                </q-item-label>
              </q-item-section>
            </q-item>

            <q-item style="max-width: 300px">
              <q-item-section avatar>
                <q-skeleton type="QAvatar" />
              </q-item-section>

              <q-item-section>
                <q-item-label>
                  <q-skeleton type="text" />
                </q-item-label>
                <q-item-label caption>
                  <q-skeleton
                    type="text"
                    width="65%"
                  />
                </q-item-label>
              </q-item-section>
            </q-item>

            <q-item style="max-width: 300px">
              <q-item-section avatar>
                <q-skeleton type="QAvatar" />
              </q-item-section>

              <q-item-section>
                <q-item-label>
                  <q-skeleton type="text" />
                </q-item-label>
                <q-item-label caption>
                  <q-skeleton
                    type="text"
                    width="90%"
                  />
                </q-item-label>
              </q-item-section>
            </q-item>

            <q-item style="max-width: 300px">
              <q-item-section avatar>
                <q-skeleton type="QAvatar" />
              </q-item-section>

              <q-item-section>
                <q-item-label>
                  <q-skeleton
                    type="text"
                    width="35%"
                  />
                </q-item-label>
                <q-item-label caption>
                  <q-skeleton type="text" />
                </q-item-label>
              </q-item-section>
            </q-item>
          </template>
        </q-infinite-scroll>
      </div>
    </q-page>
  </q-pull-to-refresh>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'Produtos',
  data () {
    return {
      categorias: [],
      final: false
    }
  },
  computed: {
    ...mapGetters({
      items: 'produtos/items',
      configuracoes: 'configuracoes/configuracoes'
    })
  },
  methods: {
    ...mapActions({
      lista: 'produtos/lista'
    }),
    async carregar (index, pronto) {
      try {
        setTimeout(async () => {
          await this.lista({
            offset: (index - 1),
            max: 1
          })
          if (this.items.length > 0) {
            this.categorias.push(this.items[0])
            pronto()
            return true
          }
          this.final = true
        }, 1000)
      } catch (error) {
        this.$app.Util.setMessage(error, 'fail')
      }
    },
    async atualizar (pronto) {
      this.final = false
      this.$refs.infiniteScroll.stop()
      this.$refs.infiniteScroll.reset()
      setTimeout(() => {
        this.categorias = []
        this.$refs.infiniteScroll.resume()
        pronto()
      }, 1000)
    }
  }
}
</script>
