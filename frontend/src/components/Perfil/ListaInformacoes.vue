<template>
  <div class="q-pa-md">
    <q-list>

      <q-item
        tag="label"
        v-ripple
      >
        <q-item-section>
          <q-item-label>Estabelecimento</q-item-label>
          <q-item-label caption>
            {{ configuracoes.nome }}
          </q-item-label>
        </q-item-section>
      </q-item>

      <q-separator />

      <q-item
        tag="label"
        v-ripple
      >
        <q-item-section>
          <q-item-label>Funcionamento</q-item-label>
          <q-item-label caption>
            {{ configuracoes.horario }}
          </q-item-label>
        </q-item-section>
      </q-item>

      <q-separator />

      <q-item
        tag="label"
        v-ripple
      >
        <q-item-section>
          <q-item-label>Telefone</q-item-label>
          <q-item-label caption>
            {{ configuracoes.telefone }}
          </q-item-label>
        </q-item-section>
      </q-item>

      <q-separator />

      <q-item
        tag="label"
        v-ripple
      >
        <q-item-section>
          <q-item-label>Site</q-item-label>
          <q-item-label caption>
            {{ configuracoes.site }}
          </q-item-label>
        </q-item-section>
      </q-item>

      <q-separator />

      <q-item
        tag="label"
        v-ripple
      >
        <q-item-section>
          <q-item-label>Email</q-item-label>
          <q-item-label caption>
            {{ configuracoes.email }}
          </q-item-label>
        </q-item-section>
      </q-item>

      <q-separator />

    </q-list>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'

export default {
  name: 'ListaInformacoes',
  computed: {
    ...mapGetters('configuracoes', [
      'configuracoes'
    ])
  },
  methods: {
    ...mapActions('configuracoes', [
      'carregar'
    ])
  },
  async mounted () {
    try {
      this.$app.Util.setLoading('Buscando informações')
      await this.carregar()
        .then(() => {
          this.$app.Util.setLoading(false)
        })
    } catch (error) {
      this.$app.Util.setLoading(false)
      this.$app.Util.setMensagem(error, 'fail')
    }
  }
}
</script>
