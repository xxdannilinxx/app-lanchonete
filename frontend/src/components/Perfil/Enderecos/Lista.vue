<template>
  <div class="q-pa-md">
    <div
      v-if="!enderecos.length && carregado"
      class="text-center"
    >
      <p>
        <img
          src="~assets/sad.svg"
          style="width:30vw;max-width:150px;"
        />
      </p>
      <p class="text-faded">Você precisa cadastrar um endereço.</p>
    </div>

    <q-list
      v-for="(endereco, index) in enderecos"
      :key="index"
    >

      <q-card class="my-card bg-grey-2 rounded-borders q-mb-md q-pt-sm q-pb-sm">
        <q-item>
          <q-item-section class="col-2">
            <q-radio
              dense
              v-model="model"
              :val="endereco.id"
              color="red"
            />
          </q-item-section>

          <q-item-section @click="model = endereco.id">
            <q-item-label>{{ endereco.titulo }}</q-item-label>
            <q-item-label caption>
              {{ `${endereco.endereco}, ${endereco.complemento}` }}
            </q-item-label>
          </q-item-section>

          <q-item-section class="col-1 text-right">
            <i
              class="material-icons text-h6"
              @click="mostrarMenu(endereco)"
            >more_vert</i>
          </q-item-section>
        </q-item>
      </q-card>

    </q-list>

    <div class="q-pa-xs">
      <q-btn
        type="submit"
        class="full-width"
        label="CADASTRAR ENDEREÇO"
        router-link
        :to="{name: 'editarendereco', params: { id: 0}}"
      />
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'

export default {
  name: 'Lista',
  data () {
    return {
      model: false,
      carregado: false
    }
  },
  async mounted () {
    try {
      this.$app.Util.setLoading('Buscando endereços...')
      await this.lista()
        .then(() => {
          this.carregado = true
          this.$app.Util.setLoading(false)
        })
    } catch (error) {
      this.carregado = true
      this.$app.Util.setLoading(false)
      this.$app.Util.setMessage(error, 'fail')
    }
  },
  computed: {
    ...mapGetters('enderecos', [
      'enderecos'
    ])
  },
  methods: {
    ...mapActions('enderecos', [
      'lista', 'remover'
    ]),
    mostrarMenu (endereco) {
      this.$q.bottomSheet({
        message: endereco.titulo,
        grid: true,
        actions: [
          {
            label: 'Editar',
            icon: 'edit',
            id: 'editar'
          },
          {
            label: 'Remover',
            icon: 'delete_forever',
            id: 'remover'
          },
          {
            label: 'Cancelar',
            icon: 'cancel',
            color: 'grey'
          }
        ]
      }).onOk(action => {
        switch (action.id) {
          case 'editar':
            this.$router.push({ name: 'editarendereco', params: { id: endereco.id } })
            break
          case 'remover':
            this.$app.Util.setConfirm('Deseja realmente remover o endereço?', () => {
              this.removerEndereco(endereco)
            }, this.$app.EmptyFn)
            break
        }
      })
    },
    async removerEndereco (endereco) {
      try {
        this.$app.Util.setLoading('Removendo endereço...')
        await this.remover({
          id: endereco.id
        })
          .then(response => {
            this.$app.Util.setLoading(false)
          })
      } catch (error) {
        this.$app.Util.setLoading(false)
        this.$app.Util.setMessage(error, 'fail')
      }
    }
  }
}
</script>
