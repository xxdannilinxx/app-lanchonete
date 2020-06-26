<template>
  <div class="q-pa-md">
    <div
      v-if="!getEnderecos.length && carregado"
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
      v-for="(endereco, index) in getEnderecos"
      :key="index"
    >

      <q-card class="my-card rounded-borders q-mb-md q-pt-md q-pb-md">
        <q-item>
          <q-item-section class="col-2">
            <q-radio
              dense
              v-model="enderecoPadrao"
              :val="endereco.id"
              color="red"
            />
          </q-item-section>

          <q-item-section @click="enderecoPadrao = endereco.id">
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
      enderecoPadrao: '',
      carregado: false
    }
  },
  async mounted () {
    try {
      this.$app.Util.setLoading('Buscando endereços...')
      await this.actionEnderecosListar()
        .then(() => {
          this.carregado = true
          this.enderecoPadrao = this.getClienteConfiguracoes.enderecoPadrao
          this.$app.Util.setLoading(false)
        })
    } catch (error) {
      this.carregado = true
      this.$app.Util.setLoading(false)
      this.$app.Util.setMessage(error, 'fail')
    }
  },
  computed: {
    ...mapGetters({
      getEnderecos: 'enderecos/enderecos',
      getClienteConfiguracoes: 'clientes/configuracoes'
    })
  },
  methods: {
    ...mapActions({
      actionEnderecosListar: 'enderecos/lista',
      actionEnderecoRemover: 'enderecos/remover',
      actionClienteConfiguracaoAlterar: 'clientes/alterarConfiguracao'
    }),
    mostrarMenu (endereco) {
      this.$q.bottomSheet({
        message: endereco.titulo,
        // grid: true,
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
            if (endereco.id === this.enderecoPadrao) {
              this.$app.Util.setMessage('Você não pode remover o seu endereço padrão.', 'info')
              return
            }
            this.$app.Util.setConfirm('Deseja realmente remover o endereço?', () => {
              this.removerEndereco(endereco)
            }, this.$app.EmptyFn)
            break
        }
      })
    },
    async removerEndereco (endereco) {
      try {
        await this.actionEnderecoRemover({
          id: endereco.id
        })
      } catch (error) {
        this.$app.Util.setMessage(error, 'fail')
      }
    }
  },
  watch: {
    getEnderecos (lista) {
      if (!this.enderecoPadrao && lista.length > 0) {
        this.enderecoPadrao = lista[0].id
      }
    },
    async enderecoPadrao (newVal, oldVal) {
      try {
        await this.actionClienteConfiguracaoAlterar(JSON.stringify({ enderecoPadrao: newVal }))
          .then(() => {
            this.enderecoPadrao = newVal
          })
      } catch (error) {
        this.enderecoPadrao = oldVal
        this.$app.Util.setMessage(error, 'fail')
      }
    }
  }
}
</script>
