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
        router-link
        :to="{name: 'perfil'}"
      >
      </q-expansion-item>
    </q-list>

    <ListaInformacoes />
  </div>
</template>

<script>
import ListaInformacoes from '../../components/perfil/listainformacoes'

export default {
  name: 'Informacoes',
  components: {
    ListaInformacoes
  }
}
</script>
