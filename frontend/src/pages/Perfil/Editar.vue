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
        router-link
        :to="{name: 'perfil'}"
      >
      </q-expansion-item>
    </q-list>

    <div>Olá</div>
  </div>
</template>

<script>
export default {
  name: 'Editar'
}
</script>
