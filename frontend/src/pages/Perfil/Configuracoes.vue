<template>
  <div class="q-pa-md">
    <q-list>

      <q-expansion-item
        expand-separator
        class="q-mb-lg text-h6"
        icon="keyboard_arrow_left"
        label="Configurações"
        header-class="text-red"
        expand-icon-class="hidden"
        router-link
        :to="{name: 'perfil'}"
      >
      </q-expansion-item>
    </q-list>

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
            v-model="escuro"
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
            {{ this.$app.versao }}
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
  name: 'Configuracoes',
  data () {
    return {
      escuro: false,
      configuracoes: {}
    }
  },
  watch: {
    async escuro (newVal, oldVal) {
      try {
        this.$q.dark.set(newVal)
        await this.alterar({
          configuracoes: JSON.stringify({ escuro: newVal })
        })
      } catch (error) {
        this.$q.dark.set(oldVal)
        this.$app.Util.setMessage(error, 'fail')
        return false
      }
    }
  },
  computed: {
    ...mapGetters('clientes', [
      'cliente'
    ])
  },
  methods: {
    ...mapActions('clientes', [
      'alterar'
    ])
  },
  created () {
    this.configuracoes = JSON.parse(this.cliente.configuracoes)
    if (this.configuracoes) {
      if (Object.prototype.hasOwnProperty.call(this.configuracoes, 'escuro')) {
        this.escuro = this.configuracoes.escuro
      }
    }
  }
}
</script>
