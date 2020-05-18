<template>
  <q-layout
    layout
    view="lHh Lpr lFf"
  >
    <Header />
    <q-page-container>
      <keep-alive>
        <router-view />
      </keep-alive>
    </q-page-container>
    <Footer />
  </q-layout>
</template>

<script>
import Header from './header'
import Footer from './footer'

export default {
  name: 'Main',
  components: {
    Header,
    Footer
  }
}
</script>
