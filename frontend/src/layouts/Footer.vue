<template>
  <div
    bordered
    slot="footer"
    class="toolbar fixed-bottom bg-light"
  >

    <q-separator />

    <q-tabs
      v-model="tabAtual"
      narrow-indicator
      dense
      keep-alive="true"
      align="justify"
      :breakpoint="0"
      slot="footer"
      class="text-red"
    >
      <q-route-tab
        v-for="(tab, index) of tabs"
        :key="index"
        :name="tab.name"
        :label="tab.label"
        class="text-red text-capitalize q-pt-sm"
        @click="tabAtual = index"
        :to="tab.route"
        :icon="tab.icon"
        replace
      />
    </q-tabs>
  </div>
</template>

<script>
export default {
  name: 'Footer',
  data () {
    return {
      tabAtual: null,
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
