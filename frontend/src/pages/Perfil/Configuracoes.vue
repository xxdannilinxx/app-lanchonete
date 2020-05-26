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

    <ConfiguracoesOpcoes />
  </div>
</template>

<script>
import ConfiguracoesOpcoes from '../../components/perfil/configuracoesopcoes'

export default {
  name: 'Configuracoes',
  components: {
    ConfiguracoesOpcoes
  }
}
</script>
