<template>
  <div class="q-pa-md">
    <q-list>
      <q-expansion-item
        expand-separator
        class="q-mb-lg text-h6"
        icon="keyboard_arrow_left"
        label="Perfil"
        header-class="text-red"
        expand-icon-class="hidden"
        @click="$router.go(-1)"
      >
      </q-expansion-item>
    </q-list>

    <EditarPerfil />
  </div>
</template>

<script>
import EditarPerfil from '../../components/perfil/editar'

export default {
  name: 'Editar',
  components: {
    EditarPerfil
  }
}
</script>
