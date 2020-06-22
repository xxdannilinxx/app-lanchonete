<template>
  <div>
    <q-list>
      <q-expansion-item
        expand-separator
        class="q-mb-lg text-h6"
        icon="keyboard_arrow_left"
        label="Endereço"
        header-class="text-red"
        expand-icon-class="hidden"
        @click="$router.go(-1)"
      >
      </q-expansion-item>
    </q-list>

    <div class="q-pa-md">
      <q-form
        @submit="enviarFormulario"
        class="q-gutter-md"
      >
        <q-input
          filled
          v-model="dados.titulo"
          label="Título"
          hint="Casa, Trabalho, outros..."
          maxlength="45"
          clearable
          autofocus
          lazy-rules
          :rules="[ val => val && val.length > 0 || 'Por favor, digite um título para o endereço']"
        />
        <q-input
          filled
          v-model="dados.endereco"
          label="Seu endereço"
          hint="Rua João da Silva"
          maxlength="255"
          clearable
          lazy-rules
          :rules="[ val => val && val.length > 0 || 'Por favor, digite o seu endereço']"
        />
        <q-input
          filled
          v-model="dados.complemento"
          label="Complemento"
          hint="Casa, Apto, Bloco..."
          maxlength="255"
          clearable
          lazy-rules
          :rules="[ val => val && val.length > 0 || 'Por favor, digite algum complemento']"
        />
        <q-select
          filled
          v-model="dados.bairro"
          :options="opcoesBairros"
          ref="selectBairros"
          option-value="id"
          option-label="nome"
          label="Bairro"
          color="primary"
          hint="Selecione o bairro"
          @filter="filtroBairros"
          lazy-rules
          :rules="[ val => val || 'Por favor, selecione o bairro do endereço']"
        >
          <template v-slot:no-option>
            <q-item>
              <q-item-section class="text-grey">
                Sem resultados
              </q-item-section>
            </q-item>
          </template>
        </q-select>

        <div class="q-pa-xs q-pt-md">
          <q-btn
            :loading="progresso"
            color="primary"
            type="submit"
            class="full-width"
          >
            Salvar
            <template v-slot:loading>
              <q-spinner-oval />
            </template>
          </q-btn>
        </div>
      </q-form>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'

export default {
  name: 'EditarEndereco',
  data () {
    return {
      model: null,
      dados: {},
      opcoesBairros: [],
      progresso: false
    }
  },
  computed: {
    ...mapGetters({
      enderecos: 'enderecos/enderecos',
      endereco: 'enderecos/endereco',
      bairros: 'bairros/bairros'
    })
  },
  methods: {
    ...mapActions({
      buscarEndereco: 'enderecos/buscar',
      alterar: 'enderecos/alterar',
      listarBairros: 'bairros/lista'
    }),
    async filtroBairros (val, update, abort) {
      if (this.opcoesBairros.length > 0) {
        await update()
        return
      }
      try {
        await this.listarBairros()
          .then(async () => {
            await update(() => {
              this.opcoesBairros = this.bairros
            })
          })
      } catch (error) {
        this.$app.Util.setMessage(error, 'fail')
      }
    },
    async enviarFormulario () {
      try {
        this.progresso = true
        await this.alterar({
          id: this.dados.id,
          titulo: this.dados.titulo,
          endereco: this.dados.endereco,
          complemento: this.dados.complemento,
          bairro: this.dados.bairro.id
        })
          .then(response => {
            this.progresso = false
            this.$router.go(-1)
          })
      } catch (error) {
        this.progresso = false
        this.$app.Util.setMessage(error, 'fail')
      }
    }
  },
  watch: {
    '$route.params.id': {
      async handler (dados) {
        if (!dados) {
          this.dados = {}
          return
        }
        try {
          this.$app.Util.setLoading('Buscando endereço...')
          await this.buscarEndereco({
            id: dados,
            max: 1
          })
            .then(() => {
              if (this.endereco.length > 0) {
                this.dados = {
                  id: this.endereco[0].id,
                  titulo: this.endereco[0].titulo,
                  endereco: this.endereco[0].endereco,
                  complemento: this.endereco[0].complemento,
                  bairro: this.endereco[0].bairro
                }
              }
              this.$app.Util.setLoading(false)
            })
        } catch (error) {
          this.$app.Util.setLoading(false)
          this.$app.Util.setMessage(error, 'fail')
        }
      },
      deep: true,
      immediate: true
    }
  }
}
</script>
