<template>
  <div class="q-pa-md">
    <q-list>
      <q-expansion-item
        expand-separator
        icon="perm_identity"
        :label="cliente.nome"
        caption="Editar perfil"
        header-class="text-red"
        expand-icon-class="hidden"
        class="bg-grey-2 rounded-borders q-mb-sm"
        router-link
        :to="{name: 'editar'}"
      >
        <template v-slot:header>
          <q-item-section avatar>
            <q-avatar>
              <img :src="'https://graph.facebook.com/' + cliente.facebook + '/picture?type=normal'">
            </q-avatar>
          </q-item-section>

          <q-item-section>
            <q-item-label>{{ cliente.nome }}</q-item-label>
            <q-item-label caption>
              Editar perfil
            </q-item-label>
          </q-item-section>
        </template>
      </q-expansion-item>
    </q-list>

    <q-list>
      <q-expansion-item
        expand-separator
        icon="room"
        label="Endereços"
        caption="Meus endereços de entrega"
        header-class="text-grey-8"
        expand-icon="keyboard_arrow_right"
        router-link
        :to="{name: 'enderecos'}"
      >
      </q-expansion-item>

      <q-separator />

      <q-expansion-item
        expand-separator
        icon="store"
        label="Informações"
        caption="Dias e horários de funcionamento"
        header-class="text-grey-8"
        expand-icon="keyboard_arrow_right"
        router-link
        :to="{name: 'informacoes'}"
      >
      </q-expansion-item>

      <q-separator />

      <q-expansion-item
        expand-separator
        icon="settings_ethernet"
        label="Configurações"
        caption="Ferramentas do aplicativo"
        header-class="text-grey-8"
        expand-icon="keyboard_arrow_right"
        router-link
        :to="{name: 'configuracoes'}"
      >
      </q-expansion-item>

      <q-separator />

      <q-expansion-item
        expand-separator
        icon="redo"
        label="Sair"
        caption="Encerre sua sessão"
        header-class="text-grey-5"
        expand-icon="keyboard_arrow_right"
        @click="confirma"
      >
      </q-expansion-item>
    </q-list>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'Menu',
  computed: {
    ...mapGetters('clientes', [
      'cliente'
    ])
  },
  methods: {
    async confirma () {
      this.$app.Util.setConfirm('Deseja realmente encerrar sua sessão?', () => {
        this.$router.push('/entrar')
      }, this.$app.EmptyFn)
    }
  }
}
</script>
