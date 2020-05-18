<template>
  <div id="q-app">
    <keep-alive>
      <router-view />
    </keep-alive>
  </div>
</template>

<script>
import Vue from 'vue'

export default {
  name: 'App',
  mounted () {
    /**
    * checa conexão com a internet
    */
    window.addEventListener('online', () => {
      this.$app.Util.setLoading(false)
    })
    window.addEventListener('offline', () => {
      this.$app.Util.setLoading('Verifique sua conexão com a internet')
    })
    /**
     * filtro de moeda
     */
    Vue.filter('moeda', function (valor) {
      return Number(valor).toLocaleString('pt-br', { style: 'currency', currency: 'BRL' })
    })
  }
}
</script>
