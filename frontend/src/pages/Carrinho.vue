<template>
  <q-page class="flex bg-grey-3 column">

  <div class="q-pa-md q-gutter-md bg-white">
    <q-list bordered class="rounded-borders" style="width: auto">

      <q-item clickable to="/produto/1" v-ripple>
        <q-item-section avatar>
          <q-avatar>
            <img src="https://cdn.quasar.dev/img/avatar2.jpg">
          </q-avatar>
        </q-item-section>

        <q-item-section>
          <q-item-label lines="1">X-Tudo</q-item-label>
          <q-item-label caption lines="2">
            O mais delecioso e suculento hamburuger da região.
          </q-item-label>
        </q-item-section>

        <q-item-section side top>
          R$ 29,90
        </q-item-section>
      </q-item>

      <q-separator inset="item" />

      <q-item clickable to="/produto/2" v-ripple>
        <q-item-section avatar>
          <q-avatar>
            <img src="https://cdn.quasar.dev/img/avatar4.jpg">
          </q-avatar>
        </q-item-section>

        <q-item-section>
          <q-item-label lines="1">X-Salada</q-item-label>
          <q-item-label caption lines="2">
            A versão mais ligth do nosso hamburguer.
          </q-item-label>
        </q-item-section>

        <q-item-section side top>
          R$ 8,00
        </q-item-section>
      </q-item>
    </q-list>

  </div>

  </q-page>
</template>

<script>
export default {
}
</script>
