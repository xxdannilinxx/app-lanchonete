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
        @click="$router.go(-1)"
      >
      </q-expansion-item>
    </q-list>

    <Opcoes />
  </div>
</template>

<script>
import Opcoes from '../../../components/perfil/configuracoes/opcoes'

export default {
  name: 'Configuracoes',
  components: {
    Opcoes
  }
}
</script>
