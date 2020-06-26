<template>
  <q-page>
    <q-list>
      <q-item
        tag="label"
        v-ripple
      >

        <q-item-section>
          <q-item-label>Nome</q-item-label>
          <q-item-label caption>
            {{ getConfiguracoes.nome }}
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
            {{ getConfiguracoes.horario }}
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
            {{ getConfiguracoes.telefone }}
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
            {{ getConfiguracoes.site }}
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
            {{ getConfiguracoes.email }}
          </q-item-label>
        </q-item-section>
      </q-item>

      <q-separator />

    </q-list>
  </q-page>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'

export default {
  name: 'Lista',
  async mounted () {
    try {
      this.$app.Util.setLoading('Buscando informações...')
      await this.actionConfiguracoesCarregar()
        .then(() => {
          this.$app.Util.setLoading(false)
        })
    } catch (error) {
      this.$app.Util.setLoading(false)
      this.$app.Util.setMessage(error, 'fail')
    }
  },
  computed: {
    ...mapGetters({
      getConfiguracoes: 'configuracoes/configuracoes'
    })
  },
  methods: {
    ...mapActions({
      actionConfiguracoesCarregar: 'configuracoes/carregar'
    })
  }
}
</script>
