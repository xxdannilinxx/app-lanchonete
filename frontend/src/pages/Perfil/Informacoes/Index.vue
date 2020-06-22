<template>
  <div class="q-pa-md">
    <q-list>
      <q-expansion-item
        expand-separator
        class="q-mb-lg text-h6"
        icon="keyboard_arrow_left"
        label="Informações"
        header-class="text-red"
        expand-icon-class="hidden"
        @click="$router.go(-1)"
      >
      </q-expansion-item>
    </q-list>

    <Lista />
  </div>
</template>

<script>
import Lista from '../../../components/perfil/informacoes/lista'

export default {
  name: 'Informacoes',
  components: {
    Lista
  }
}
</script>
