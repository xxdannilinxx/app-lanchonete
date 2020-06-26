<template>
  <q-page>
    <BarraTop />
    <Lista />
  </q-page>
</template>

<script>
import BarraTop from '../../../components/abstratos/barratop'
import Lista from '../../../components/perfil/enderecos/lista'

export default {
  name: 'Enderecos',
  components: {
    BarraTop,
    Lista
  }
}
</script>
