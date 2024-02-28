<script>
import LoadingComponent from "@/components/Uteis/LoadingComponent.vue";
import NotificacaoComponent from "@/components/Uteis/NotificacaoComponent.vue";
import NavbarSistemaComponent from "@/components/Navbar/NavbarSistemaComponent.vue";
import {router} from "@inertiajs/vue3";
import {helpers, maxLength, required} from "@vuelidate/validators";
import {useVuelidate} from "@vuelidate/core";

export default {
  setup() {
    return {
      v$: useVuelidate()
    }
  },
  methods: {
    router() {
      return router
    },
    async cadastrar() {
      this.loading = true
      if (await this.v$.unidade.$validate()) {
        this.router().post('cadastrar', this.unidade)
      }
      this.loading = false
    }
  },
  components: {
    LoadingComponent,
    NotificacaoComponent,
    NavbarSistemaComponent
  },
  data() {
    return {
      loading: false,
      unidade: {
        'unidade_produto_nome': '',
        'unidade_produto_sigla': ''
      }
    }
  },
  props: {
    menus: {
      type: Array,
      required: true
    },
    subMenus: {
      type: Array,
      required: true
    }
  },
  validations() {
    return {
      unidade: {
        unidade_produto_nome: {
          required: helpers.withMessage(
              'Esse campo é obrigatório, por favor, informe-o.',
              required
          ),
          maxLength: helpers.withMessage(
              'Esse campo tem que conter no máximo 50 caracteres.',
              maxLength(50)
          )
        },
        unidade_produto_sigla: {
          required: helpers.withMessage(
              'Esse campo é obrigatório, por favor, informe-o.',
              required
          ),
          maxLength: helpers.withMessage(
              'Esse campo tem que conter no máximo 5 caracteres.',
              maxLength(5)
          )
        }
      }
    }
  }
}
</script>

<template>
  <v-layout>
    <NavbarSistemaComponent :menus="menus" :subMenus="subMenus" />
    <NotificacaoComponent
        :notificacao="this.$page.props.flash.backendFlashMessage"
        v-if="this.$page.props.flash.backendFlashMessage"
    />
    <LoadingComponent :loading="loading" />
    <v-main>
      <div class="container-cadastro-unidade">
        <h2>Aqui você poderá cadastrar novas unidades de medida de produtos!</h2>
        <form class="form-cadastro-unidade" @submit.prevent="cadastrar">
          <v-row>
            <v-col cols="6">
              <v-text-field
                  type="text"
                  v-model="unidade.unidade_produto_nome"
                  :error-messages="
                  v$.unidade.unidade_produto_nome.$errors.map((e) => e.$message)
                "
                  counter="50"
                  label="Insira o nome da unidade de medida"
                  @input="v$.unidade.unidade_produto_nome.$touch"
                  @blur="v$.unidade.unidade_produto_nome.$touch"
              ></v-text-field
              ></v-col>
            <v-col cols="6">
              <v-text-field
                  type="text"
                  v-model="unidade.unidade_produto_sigla"
                  :error-messages="
                  v$.unidade.unidade_produto_sigla.$errors.map((e) => e.$message)
                "
                  counter="5"
                  label="Insira a sigla da unidade de medida"
                  @input="v$.unidade.unidade_produto_sigla.$touch"
                  @blur="v$.unidade.unidade_produto_sigla.$touch"
              ></v-text-field>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" class="botoes">
              <v-btn variant="tonal" @click="$router.go(-1)" color="var(--vermilion)">Voltar</v-btn>
              <v-btn variant="tonal" type="submit" color="var(--green-confirm)">Salvar</v-btn>
            </v-col>
          </v-row>
        </form>
      </div>
    </v-main>
  </v-layout>
</template>

<style scoped>
.container-cadastro-unidade {
  padding: 4rem;
  font-family: 'Poppins', sans-serif;
  width: 90%;
}

.form-cadastro-unidade {
  padding: 3rem;
}

.botoes {
  display: flex;
  gap: 1rem;
  justify-content: end;
}
</style>