<template>
  <q-bar class="bg-primary text-white q-pa-md">
    <q-btn
      dense
      flat
      icon="arrow_back"
      @click="$router.go(-1)"
    />
    <div class="text-weight-bold q-pl-sm">
      {{ $route.meta.title }}
    </div>
  </q-bar>
</template>

<script>
export default {
  name: 'BarraTop'
}
</script>
