<template>
  <div class="check-empty">
    <div
      v-if="!items.length && loaded"
      class="nenhum-resultado fixed-center text-center"
    >
      <p>
        <img
          src="~assets/sad.svg"
          style="width:30vw;max-width:150px;"
        />
      </p>
      <p class="text-faded">Desculpe, não encontramos nada por aqui.</p>
    </div>

    <div
      v-if="items.length"
      class="q-pa-md q-gutter-md"
    >
      <div
        v-for="categoria in items"
        :key="categoria.nome"
      >
        {{ categoria.nome }}
        <p
          v-if="!categoria.produtos.length"
          class="text-faded"
        >Desculpe, não encontramos nada por aqui.</p>

        <q-list
          v-for="produto in categoria.produtos"
          :key="produto.id"
        >
          <q-item
            clickable
            :to="'/produto/' + produto.id"
            v-ripple
          >
            <q-item-section avatar>
              <q-avatar>
                <img src="https://cdn.quasar.dev/img/avatar2.jpg" />
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
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  name: 'Produtos',
  created () {
    this.lista().then(response => {
      if (!response.success) {
        this.$app.Util.setMessage(response.message, 'fail')
      }
    })
  },
  computed: {
    ...mapGetters('produtos', [
      'items',
      'loaded'
    ])
  },
  methods: {
    ...mapActions('produtos', [
      'lista'
    ])
  }
}
</script>
