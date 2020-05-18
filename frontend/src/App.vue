<template>
  <div id="q-app">
    <keep-alive>
      <router-view />
    </keep-alive>
  </div>
</template>

<script>
import Vue from 'vue'
import store from './store'

export default {
  store,
  name: 'App',
  created () {
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
     * filtro de moeda em real
     */
    Vue.filter('moeda', function (valor) {
      return Number(valor).toLocaleString('pt-br', { style: 'currency', currency: 'BRL' })
    })
    /**
     *
     */
    console.log('App iniciado com sucesso!')
    console.log('Backend: ' + this.$app.baseURL)
    console.log('Versão: ' + this.$app.version)
  }
}
</script>
