<template>
  <q-page>
    <BarraTop />
    <EditarPerfil />
  </q-page>
</template>

<script>
import BarraTop from '../../components/abstratos/barratop'
import EditarPerfil from '../../components/perfil/editar'

export default {
  name: 'Editar',
  components: {
    BarraTop,
    EditarPerfil
  }
}
</script>
