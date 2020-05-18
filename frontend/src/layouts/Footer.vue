<template>
  <q-footer class="bg-white">
    <q-tabs
      v-model="atualTab"
      narrow-indicator
      dense
      keep-alive="true"
      align="justify"
      :breakpoint="0"
    >
      <q-route-tab
        v-for="tab of tabs"
        :key="tab.name"
        :name="tab.name"
        :label="tab.label"
        class="text-red text-capitalize q-pt-sm"
        @click="atualTab = index"
        :to="tab.route"
        :icon="tab.icon"
      />
    </q-tabs>
  </q-footer>
</template>

<script>
export default {
  name: 'Footer',
  data () {
    return {
      atualTab: null,
      tabs: [
        { name: 'inicio', label: 'inicio', icon: 'storefront', route: '/' },
        { name: 'carrinho', label: 'Carrinho', icon: 'shopping_cart', route: '/carrinho' },
        { name: 'pedidos', label: 'Pedidos', icon: 'bookmark_border', route: '/pedidos' },
        { name: 'perfil', label: 'Perfil', icon: 'face', route: '/perfil' }
      ]
    }
  }
}
</script>
