<template>
  <div class="q-pa-md">
    <q-list>
      <q-item
        tag="label"
        v-ripple
      >
        <q-item-section>
          <q-item-label>Modo escuro</q-item-label>
          <q-item-label caption>Maior conforto ao acessar em ambientes escuros</q-item-label>
        </q-item-section>

        <q-item-section avatar>
          <q-toggle
            color="red"
            v-model="$q.dark.isActive"
            val="picture"
          />
        </q-item-section>
      </q-item>

      <q-separator />

      <q-item
        tag="label"
        v-ripple
      >
        <q-item-section>
          <q-item-label>Versão do aplicativo</q-item-label>
          <q-item-label caption>
            {{ $app.versao }}
          </q-item-label>
        </q-item-section>
      </q-item>

      <q-separator />

    </q-list>
  </div>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  name: 'Opcoes',
  methods: {
    ...mapActions({
      actionClienteAlterar: 'clientes/alterar',
      actionClienteConfiguracaoAlterar: 'clientes/alterarConfiguracao'
    })
  },
  watch: {
    async '$q.dark.isActive' (newVal, oldVal) {
      try {
        this.$app.Util.setLoading('Alterando configurações...')
        await this.actionClienteConfiguracaoAlterar(JSON.stringify({ escuro: newVal }))
          .then(() => {
            this.$q.dark.set(newVal)
            this.$app.Util.setLoading(false)
          })
      } catch (error) {
        this.$q.dark.set(oldVal)
        this.$app.Util.setLoading(false)
        this.$app.Util.setMessage(error, 'fail')
      }
    }
  }
}
</script>
