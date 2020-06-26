<template>
  <q-page>
    <BarraTop />
    <Lista />
  </q-page>
</template>

<script>
import BarraTop from '../../../components/abstratos/barratop'
import Lista from '../../../components/perfil/informacoes/lista'

export default {
  name: 'Informacoes',
  components: {
    BarraTop,
    Lista
  }
}
</script>
