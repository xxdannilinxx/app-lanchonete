<template>
  <q-page>
    <BarraTop />
    <Opcoes />
  </q-page>
</template>

<script>
import BarraTop from '../../../components/abstratos/barratop'
import Opcoes from '../../../components/perfil/configuracoes/opcoes'

export default {
  name: 'Configuracoes',
  components: {
    BarraTop,
    Opcoes
  }
}
</script>
