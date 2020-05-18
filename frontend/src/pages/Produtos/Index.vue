<template>
  <q-page class="flex bg-white-3 column">
    <Lista />
  </q-page>
</template>

<script>
import Lista from '../../components/produtos/lista'

export default {
  name: 'Produtos',
  components: {
    Lista
  }
}
</script>
